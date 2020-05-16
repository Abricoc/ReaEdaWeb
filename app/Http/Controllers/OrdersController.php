<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * @param $DeviceID
     * @param $Message
     */
    private function SendNotification($DeviceID, $Message){
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

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|void
     */
    public function CheckOut(Request $request){
        $products = $request->user()->cart;
        if(isNull($products)){
            return response([
                'status' => "Cart is empty"
            ], 200);
        }elseif(count($products) == 0){
            return response([
                'status' => "Cart is empty"
            ], 200);
        }
        $order = new Order;
        $order->status = 'Принято в обработку';
        $order->user_id = $request->user()->id;
        $order->comment = $request->input('comment');
        $order->products = $request->user()->cart;
        $order->save();
        $this->SendNotification($request->user()->device_id, "Заказ №" . $order->id . " успешно оформлен");
        return response([
            'status' => "Success"
        ], 200);
    }

}