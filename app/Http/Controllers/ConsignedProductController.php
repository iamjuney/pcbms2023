<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\ConsignedDetail;
use App\Models\ConsignedProduct;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class ConsignedProductController extends Controller
{
    public function index(): Response
    {
        $consignedProducts = ConsignedDetail::with(['consignedProduct', 'product'])
            ->join('consigned_products', 'consigned_details.cp_id', '=', 'consigned_products.cp_id')
            ->join('products', 'consigned_details.prod_id', '=', 'products.prod_id')
            ->join('suppliers', 'consigned_products.supp_id', '=', 'suppliers.supp_id')
            ->select([
                'consigned_details.item_id',
                'consigned_products.cp_id',
                'consigned_products.supp_id',
                'suppliers.company',
                'suppliers.address',
                'consigned_products.userid',
                'products.prod_id',
                'products.prod_name',
                'products.unit',
                'consigned_details.barcode',
                'consigned_details.particulars',
                'consigned_details.expiry_date',
                'consigned_details.unit_price',
                'consigned_details.selling_price',
                'consigned_details.quantity',
                'consigned_details.amount',
            ])
            ->get();

        $suppliers = Supplier::select(['supp_id', 'company'])
            ->orderBy('company')
            ->get();

        $products = Product::select(['prod_id', 'prod_name'])
            ->orderBy('prod_name')
            ->get();

        return Inertia::render('ConsignedInventory', [
            'consignedProducts' => $consignedProducts,
            'suppliers' => $suppliers,
            'products' => $products,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'supp_id' => 'required',
            'userid' => 'required',
            'date_received' => 'required',
            'prod_id' => 'required',
            'barcode' => 'required',
            'particulars' => 'required',
            'expiry_date' => 'required',
            'unit_price' => 'required',
            'selling_price' => 'required',
            'quantity' => 'required',
            'amount' => 'required',
        ]);

        $consignedProduct = ConsignedProduct::create([
            'supp_id' => $request->supp_id,
            'userid' => $request->userid,
            'date_received' => $request->date_received,
        ]);

        $consignedDetail = ConsignedDetail::create([
            'cp_id' => $consignedProduct->cp_id,
            'prod_id' => $request->prod_id,
            'barcode' => $request->barcode,
            'particulars' => $request->particulars,
            'expiry_date' => $request->expiry_date,
            'unit_price' => $request->unit_price,
            'selling_price' => $request->selling_price,
            'quantity' => $request->quantity,
            'amount' => $request->amount,
        ]);

        if ($consignedProduct && $consignedDetail) {
            return to_route('consigned-inventory');
        } else {
            throw ValidationException::withMessages([
                'message' => 'Order creation failed'
            ]);
        }
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'cp_id' => 'required',
            'supp_id' => 'required',
            'userid' => 'required',
            'date_received' => 'required',
            'prod_id' => 'required',
            'barcode' => 'required',
            'particulars' => 'required',
            'expiry_date' => 'required',
            'unit_price' => 'required',
            'selling_price' => 'required',
            'quantity' => 'required',
            'amount' => 'required',
        ]);

        $consignedProduct = ConsignedProduct::find($request->cp_id);
        $consignedDetail = ConsignedDetail::where('cp_id', $request->cp_id)->first();

        if ($consignedProduct && $consignedDetail) {
            $consignedProduct->update([
                'supp_id' => $request->supp_id,
                'userid' => $request->userid,
                'date_received' => $request->date_received,
            ]);

            $consignedDetail->update([
                'prod_id' => $request->prod_id,
                'barcode' => $request->barcode,
                'particulars' => $request->particulars,
                'expiry_date' => $request->expiry_date,
                'unit_price' => $request->unit_price,
                'selling_price' => $request->selling_price,
                'quantity' => $request->quantity,
                'amount' => $request->amount,
            ]);

            return to_route('consigned-inventory');
        } else {
            throw ValidationException::withMessages([
                'message' => 'Order update failed'
            ]);
        }
    }

    public function destroy(int $cp_id): RedirectResponse
    {
        $product = ConsignedProduct::find($cp_id);

        if ($product) {
            $product->delete();
            return to_route('consigned-inventory');
        } else {
            throw ValidationException::withMessages([
                'message' => 'Order deletion failed'
            ]);
        }
    }
}
