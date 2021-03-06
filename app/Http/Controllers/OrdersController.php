<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExport;
use App\Mail\CheckOut;
use App\Mail\ResetPasswords;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class OrdersController extends Controller
{
    public static $StatusDictionary = [
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
        $order->select_date = $request->input('select_date');
        $order->place_name = Product::findorfail($products[0]['product']['id'])->place->place_name;
        $order->final_amount = $FinalAmount;
        $order->products = $products;
        $order->payment_status = 'Оплата ещё не произведена';
        $FinalAmount = $FinalAmount * 100;
        $orderNumber = "Тестовый%20заказ%20№" . $order->id;
        $info = file_get_contents("https://3dsec.sberbank.ru/payment/rest/register.do?userName=rea_1-api&password=rea_1&amount=$FinalAmount&returnUrl=https://eda.ucmpt.ru&orderNumber=$orderNumber&pageView=MOBILE&features=FORCE_FULL_TDS");
        $info = json_decode($info, true);
        $order->sberId = $info['orderId'];
        $order->save();
        Mail::to("eda@rea.ru")->send(new CheckOut($order));
        return $info;
    }

    public function Orders(){
        return view('orders.index', [
            'Orders' => Order::where('status', self::$StatusDictionary['Accepted'])->orWhere('status', self::$StatusDictionary['Cook'])->orWhere('status', self::$StatusDictionary['Ready'])->orderBy('id', 'desc')->get(),
            'Statuses' => [
                'Accepted' => 'Заказ принят в обработку',
                'Cook' => 'Заказ в процессе приготовления',
                'Ready' => 'Заказ готов к выдаче',
                'Issued' => 'Заказ выдан клиенту',
                'CancelledByREA' => 'Заказ отменён рестораном'
            ],
            'lastId' => Order::where('status', self::$StatusDictionary['Accepted'])->orWhere('status', self::$StatusDictionary['Cook'])->orWhere('status', self::$StatusDictionary['Ready'])->orderBy('id', 'desc')->first()->id
        ]);
    }

    public function CompleteOrders(){
        return view('orders.complete',[
            'Orders' => Order::where('status', self::$StatusDictionary['Issued'])->orWhere('status', self::$StatusDictionary['CancelledByClient'])->orWhere('status', self::$StatusDictionary['CancelledByREA'])->orderBy('id', 'desc')->get(),
        ]);
    }

    public function ChangeStatus(Request $request){
        $order = Order::findorfail($request->input('orderId'));
        $order->status = self::$StatusDictionary[$request->input('newStatus')];
        $order->save();
        foreach ($order->user->devices as $device){
            $this->SendNotification($device->device_token, "Заказ №" . $order->id . " статус изменён на " . self::$StatusDictionary[$request->input('newStatus')]);
        }
        return back();
    }

    public function GetMyOrders(Request $request){
        $ordersList = Order::select(['id', 'status', 'place_name', 'comment', 'products', 'final_amount', 'select_date', 'created_at'])->where('user_id', $request->user()->id)->orderBy('id', 'desc')->get();
        $orders = [];
        foreach ($ordersList as $order){
            $orders[] = [
                'order' => $order,
                'decline' => ($order->status == self::$StatusDictionary['Accepted']) && (date("dmY") == date('dmY', strtotime($order->created_at)))
            ];
        }
        return $orders;
    }

    public function DeclineOrder(Request $request){
        if($request->has('orderID')){
            $orderID = $request->input('orderID');
            $order = Order::findorfail($orderID);
            if($order->user->id == $request->user()->id){
                if($order->status == self::$StatusDictionary['Accepted']){
                    $order->status = self::$StatusDictionary['CancelledByClient'];
                    $order->save();
                    if($request->user()->device_id != '') {
                        $this->SendNotification($request->user()->device_id, "Заказ №" . $order->id . " отменён");
                    }
                    return response([
                        'status' => 'Заказ отменён'
                    ], 200);
                }else{
                    return response([
                        'status' => 'Непредвиденная ошибка 1'
                    ], 200);
                }
            }else{
                return response([
                    'status' => 'Непредвиденная ошибка 2'
                ], 200);
            }
        }else{
            return response([
                'status' => 'Непредвиденная ошибка 3'
            ], 200);
        }
    }

    public function show(Request $request, $id){
        $order = Order::findorfail($id);
        return view('orders.show', [
            'order' => $order
        ]);
    }

    public function hasUpdate(Request $request){
        $id = $request->input('lastId');
        $lastId = Order::where('status', self::$StatusDictionary['Accepted'])->orWhere('status', self::$StatusDictionary['Cook'])->orWhere('status', self::$StatusDictionary['Ready'])->orderBy('id', 'desc')->first()->id;
        if($id < $lastId) {
            return [
                'status' => 'Update'
            ];
        }
        else{
            return [
                'status' => 'NotUpdate'
            ];
        }
    }

    public function ExportToExcel(Request $request){
        return Excel::download(new OrdersExport(), 'Заказы на ' . date('d.m.Y H:i:s') . '.xlsx');
    }
}
