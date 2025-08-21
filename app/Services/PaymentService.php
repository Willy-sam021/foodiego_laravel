<?php
namespace App\Services;
use App\Repositories\PaymentRepository;
use App\Repositories\OrderRepository;
use App\Actions\Payment\PaymentConversion;
use Exception;
use Illuminate\Support\Str;
use App\Actions\Payment\PaymentPaystack;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


class PaymentService{
    public function __construct(public PaymentRepository $paymentRepo, public OrderRepository $orderRepository )
    {

    }

    public function create($order,$reference){
        $payment = $this->paymentRepo->create($order,$reference);
        if(!$payment){
            return false;
        }
        return $payment;
    }



    public function getOrderCollection($id){
        $order = $this->orderRepository->getOrderCollection($id);
        if(!$order){
            Log::error('order not found');
            return false;
        }
        return $order;
    }

    public function verifyRef($id){
        $orderId= orderId();
        $payment=$this->paymentRepo->findReferenceId($id);
        if(!$payment){
            Log::error('payment not found');
            abort('433', 'Payment Verification Failed');
        }
        if($payment->order_id != $orderId){
            Log::error('payment not found');
            abort('433', 'Payment Verification Failed');
        }
        return $payment;
    }

    public function initialize($currency){
        $order = $this->orderRepository->getSingleOrder(session('order_id'));
        $reference = Str::ulid()->toBase32();
        $payment = $this->create($order,$reference);
        if(!$payment){
            return false;
        }
        try{
            $url = config('services.payment.Paystack_url');
            $fields = [
                'email' => Auth::user()->email,
                'amount' => $order->total_price *100,
                'reference'=> $reference,
                'currency' => $currency,
                'callback_url' => config('services.payment.paystack_initialize'),
            ];

            $response = PaymentPaystack::initialize($url,$fields);

        }catch(Exception $e){
            Log::error($e->getMessage());
            Log::error($e);
            return false;
        }

        $data = $response->json();
        return $data;
    }


    public function callback($request ){
        $reference = $request->query('reference');
            if (!$reference) {
               return false;
            }
        $ref= $this->verifyRef($reference);
        $reference= $ref->payment_reference;
        $verify = PaymentPaystack::verify($reference);
        if (!$verify->successful() || $verify->json('status') !== true) {
                return false;
            }

        $data = $verify->json('data');
        try{
            if (($data['status'] ?? null) === 'success') {

                $res = new PaymentConversion($data);
                $updated_payment = $this->paymentRepo->update($data, $ref->id,$res->amount);
                $updated_order=$this->orderRepository->paymentUpdate($updated_payment);
                return true;
              
            }else{
                $res = new PaymentConversion($data);
                $updated_payment = $this->paymentRepo->update($data, $ref->id,$res->amount);
                return false;
            }
        }catch(Exception $e){
            Log::emergency($e->getMessage());
            return false;
        }


    }

}


?>
