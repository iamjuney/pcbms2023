<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index(): Response
    {
        $sales = Sale::with(['customer', 'user'])
            ->join('customers', 'sales.cust_id', '=', 'customers.cust_id')
            ->join('users', 'sales.userid', '=', 'users.userid')
            ->join('sales_details', 'sales.sale_id', '=', 'sales_details.sale_id')
            ->select([
                'sales.sale_id',
                'sales.date_issued',
                'sales_details.item_id',
                'sales_details.qty_sold',
                'sales_details.amount_sold',
                'customers.cust_id',
                'customers.name',
                'customers.address',
                'users.username',
                'users.role'
            ])
            ->get();

        $customers = Customer::select(['cust_id', 'name'])
            ->orderBy('name')
            ->get();

        return Inertia::render('Sales', [
            'sales' => $sales,
            'customers' => $customers,
        ]);
    }
}
