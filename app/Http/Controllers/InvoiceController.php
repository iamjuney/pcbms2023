<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\ConsignedDetail;
use App\Models\ConsignedProduct;
use Illuminate\Http\RedirectResponse;

class InvoiceController extends Controller
{
    public function index(): Response
    {
        $customers = Customer::select(['cust_id', 'name', 'address'])
            ->orderBy('name')
            ->get();

        $consignedProducts = ConsignedDetail::with('product')
            ->select(['item_id', 'prod_id', 'barcode', 'selling_price', 'quantity'])
            ->orderBy('item_id')
            ->get(
                [
                    'item_id',
                    'prod_id',
                    'barcode',
                    'selling_price',
                    'quantity',
                ]
            );

        return Inertia::render('Invoice', [
            'customers' => $customers,
            'consignedProducts' => $consignedProducts,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        // dd($request->products);
        $request->validate([
            'cust_id' => 'required|integer',
            'date_issued' => 'required|date',
        ]);

        $invoice = Sale::create([
            'cust_id' => $request->cust_id,
            'date_issued' => $request->date_issued,
            'userid' => auth()->user()->userid,
        ]);

        $products = $request->products;

        //create sales_details for each product
        foreach ($products as $product) {
            //update quantity of consigned details
            $consignedDetail = ConsignedDetail::where('item_id', $product['product']['item_id'])
                ->first();

            $consignedDetail->quantity -= $product['qty_sold'];
            $consignedDetail->save();

            $invoice->saleDetails()->create([
                'item_id' => $consignedDetail->item_id,
                'barcode' => $product['product']['barcode'],
                'qty_sold' => $product['qty_sold'],
                'amount_sold' => $product['qty_sold'] * $product['product']['selling_price'],
            ]);
        }

        return to_route('invoice');
    }
}
