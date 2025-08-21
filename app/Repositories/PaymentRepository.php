<?php
namespace App\Repositories;
use App\Models\Payment;
use App\Enums\PaymentStatusEnums;
use Illuminate\Support\Facades\Auth;

class PaymentRepository{
    public function all(){
        $payment= Payment::all();
        return $payment;
    }


    public function create($order,$reference){
        $payment = Payment::create([
            'order_id' => $order->id,
            'user_id' => Auth::user()->id,
            'payment_reference' => $reference,
        ]);
        return $payment;

    }
    public function findReferenceId($refId){
        $payment= Payment::where('payment_reference',$refId)->first();
        return $payment;
    }

    public function findById($id){
        $payment = Payment::findOrFail($id);
        return $payment;
    }



    public function update($data, $id, $amount){
        $payment= $this->findById($id);

         $payment->update([
            "amount" => $amount,
            "paid_at" => date('Y-m-d H:i:s', strtotime($data['paidAt'])),
            "payment_status" => $data['status']?PaymentStatusEnums::SUCCESSFUL->value: PaymentStatusEnums::FAILED->value,


        ]);
       
        return $payment;
    }

   }
?>
