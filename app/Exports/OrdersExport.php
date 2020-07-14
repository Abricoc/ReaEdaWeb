<?php

namespace App\Exports;

use App\Http\Controllers\OrdersController;
use App\Models\Order;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class OrdersExport implements FromView, ShouldAutoSize
{
    public function view(): \Illuminate\Contracts\View\View
    {
        return view('exports.orders', [
            'orders' => Order::where('status', OrdersController::$StatusDictionary['Accepted'])->orWhere('status', OrdersController::$StatusDictionary['Cook'])->orWhere('status', OrdersController::$StatusDictionary['Ready'])->orderBy('id', 'desc')->get()
        ]);
    }
}
