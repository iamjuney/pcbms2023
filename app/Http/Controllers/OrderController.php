<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Order;
use Inertia\Response;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

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
                'orders.or_id',
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

        $suppliers = Supplier::select(['supp_id', 'company'])
            ->orderBy('company')
            ->get();

        $products = Product::select(['prod_id', 'prod_name'])
            ->orderBy('prod_name')
            ->get();

        return Inertia::render('Orders', [
            'orders' => $orderDetails,
            'suppliers' => $suppliers,
            'products' => $products,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'supp_id' => 'required',
            'userid' => 'required',
            'status' => 'required',
            'item_id' => 'required',
            'quantity' => 'required',
        ]);

        $order_date = date('Y-m-d H:i:s');

        $order = Order::create([
            'supp_id' => $request->supp_id,
            'userid' => $request->userid,
            'order_date' => $order_date,
            'status' => $request->status,
        ]);

        $orderDetail = OrderDetail::create([
            'order_id' => $order->or_id,
            'item_id' => $request->item_id,
            'quantity' => $request->quantity,
        ]);

        if ($order && $orderDetail) {
            // Order creation was successful
            return to_route('orders');
        } else {
            // Order creation failed
            throw ValidationException::withMessages([
                'message' => 'Order creation failed'
            ]);
        }
    }

    public function destroy(int $or_id): RedirectResponse
    {
        $order = Order::find($or_id);

        if ($order) {
            $order->delete();
            return to_route('orders');
        } else {
            throw ValidationException::withMessages([
                'message' => 'Order deletion failed'
            ]);
        }
    }
}
