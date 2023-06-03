<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(): Response
    {
        $orderDetails = OrderDetail::with(['order', 'product'])
            ->join('orders', 'order_details.order_id', '=', 'orders.or_id')
            ->join('products', 'order_details.item_id', '=', 'products.prod_id')
            ->join('suppliers', 'orders.supp_id', '=', 'suppliers.supp_id')
            ->join('users', 'orders.userid', '=', 'users.userid')
            ->select([
                'order_details.item_no',
                'suppliers.company',
                'suppliers.address',
                'users.username',
                'users.role',
                'products.prod_name',
                'products.unit',
                'order_details.quantity',
                'orders.order_date',
                'orders.status',
            ])
            ->get();

        return Inertia::render('Orders', [
            'orders' => $orderDetails,
        ]);
    }
}
