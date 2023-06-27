<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Models\ConsignedProduct;

class ConsignedProductController extends Controller
{
    public function index(): Response
    {
        $consignedProducts = ConsignedProduct::select(['cp_id', 'supp_id', 'userid', 'date_received', 'created_at', 'updated_at'])->get();

        return Inertia::render('ConsignedProducts', [
            'consignedProducts' => $consignedProducts
        ]);
    }
}
