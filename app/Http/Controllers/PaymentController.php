<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PaymentService;
use App\Actions\Payment\RedirectResponse;
use App\Http\Requests\Payment\CurrencyRequest;
class PaymentController extends Controller
{
    public function __construct(public PaymentService $paymentService){

    }

    public function index(){
        $order= $this->paymentService->getOrderCollection(session('order_id'));
        if(!$order){
            abort('433', 'An error occured');
        }
        return view('payment.payment-confirm',['orders'=>$order]);
    }

    public function paymentInitialize(CurrencyRequest $request){
        $data = $request->validated();
        //dd($currency);
        $response = $this->paymentService->initialize($data['payment_currency']);
        //dd($response);
       if ($response['status'] === true) {
            return redirect()->away($response['data']['authorization_url']);
        }else {
            RedirectResponse::paymentRedirect('payment.payment-callback-error');
        }
    }

    public function callback(Request $request){

        $verify= $this->paymentService->callback($request);

        if(!$verify){
          return  RedirectResponse::paymentRedirect('payment.payment-callback-error');
        }
        return  RedirectResponse::paymentRedirect('payment.payment-callback-success');

    }


}
