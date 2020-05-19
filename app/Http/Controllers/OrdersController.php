<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    private static $StatusDictionary = [
        'Accepted' => 'Заказ принят в обработку',
        'Cook' => 'Заказ в процессе приготовления',
        'Ready' => 'Заказ готов к выдаче',
        'Issued' => 'Заказ выдан клиенту',
        'CancelledByClient' => 'Заказ отменён клиентом',
        'CancelledByREA' => 'Заказ отменён столовой'
    ];

    /**
     * @param $DeviceID
     * @param $Message
     */
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

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|void
     */
    public function CheckOut(Request $request){
        $products = $request->user()->cart;
        if(is_null($products)){
            return response([
                'status' => "Cart is empty"
            ], 200);
        }elseif(count($products) == 0){
            return response([
                'status' => "Cart is empty"
            ], 200);
        }
        $order = new Order;
        $order->status = self::$StatusDictionary['Accepted'];
        $order->user_id = $request->user()->id;
        if($request->input('comment') != ''){
            $order->comment = $request->input('comment');
        }
        else{
            $order->comment = 'Комментарий отсутствует';
        }
        $FinalAmount = 0;
        for ($i = 0; $i < count($products); $i++)
        {
            $FinalAmount += $products[$i]['price'];
        }
        $order->final_amount = $FinalAmount;
        $order->products = $products;
        $order->save();
        if($request->user()->device_id != '') {
            $this->SendNotification($request->user()->device_id, "Заказ №" . $order->id . " успешно оформлен!!!");
        }
        $request->user()->cart = null;
        $request->user()->save();
        return response([
            'status' => "Success"
        ], 200);
    }

    public function Orders(){
        return view('orders.index');
    }

    public function CompleteOrders(){
        return view('orders.complete');
    }

    public function ChangeStatus(Request $request){

    }

    public function GetMyOrders(Request $request){
        return Order::select(['id', 'status', 'comment', 'products', 'created_at', 'final_amount'])->where('user_id', 15)->get();
    }
}
