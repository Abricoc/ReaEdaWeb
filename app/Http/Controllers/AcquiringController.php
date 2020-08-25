<?php

namespace App\Http\Controllers;

use App\Mail\Check;
use App\Models\Order;
use Illuminate\Http\Request;

class AcquiringController extends Controller
{
    public static function SendNotification($DeviceID, $Message){
        $data = [
            "to" => $DeviceID,
            "notification" => [
                "title" => "REA EDA",
                "body" => $Message,
                "icon" => "",
                "click_action" => ""]
        ];
        $headers = [
            'Authorization: key=AAAAnpwrlD8:APA91bHvvCzhvadVmtip4Ifr1Dcbz_MJBRldG4S8cD_KLIne3pUQ4QZHmW8QciFhLnIY0Px84tnOnHEd7dtOAfWUbxRvAq1VoSu_8YMKBU7UV278phw6z9Np7KT7LwRefwafkCCf0CAL',
            'Content-Type: application/json'
        ];
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode($data));
        curl_exec($ch);
        curl_close ($ch);
    }

    public function Success(Request $request){
        $sberId = $request->get('orderId');
        $order = Order::where('sberId', $sberId)->first();
        $order->payment_status = 'Оплата прошла успешно';
        $order->user->cart = null;
        $order->user->save();
        foreach ($order->user->devices as $device){
            $this->SendNotification($device->device_token, "Заказ №" . $order->id . " успешно оформлен!");
        }
        $order->save();
        Mail::to($order->user->email)->send(new Check($order));
        return view('acquiring.success');
    }

    public function Fail(Request $request){
        $sberId = $request->get('orderId');
        $order = Order::where('sberId', $sberId)->first();
        $order->payment_status = 'Оплата не прошла';
        foreach ($order->user()->devices as $device){
            $this->SendNotification($device->device_token, "Заказ №" . $order->id . " отменён, по причине отсутствия оплаты!");
        }
        $order->save();
        return view('acquiring.fail');
    }
}
