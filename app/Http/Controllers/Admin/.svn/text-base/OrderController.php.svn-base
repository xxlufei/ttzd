<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-11-12
 * Time: 14:03
 */

namespace App\Http\Controllers\Admin;


use App\Core\Dao\Front\OrderDetail;
use App\Core\Dao\Front\Orders;
use Illuminate\Http\Request;

class OrderController
{
    public function orderList(Request $request)
    {
        $orders = Orders::getAllPayOrder();
        return view('admin.orderlist', ['orders' => $orders]);
    }

    public function orderDetail(Request $request)
    {
        $orderId = $request['orderId'];
        $orderDetail = OrderDetail::getOrderDetailByOrderId($orderId);
        return view('admin.orderdetail', ['orderDetail' => $orderDetail]);
    }
}