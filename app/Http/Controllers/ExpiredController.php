<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Supplier;
use App\Models\ExpiredItem;
use Illuminate\Http\Request;

class ExpiredController extends Controller
{
    public function index(): Response
    {
        $expiredItems = ExpiredItem::with(['expired', 'consignedDetail'])
            ->join('expireds', 'expired_items.exp_id', '=', 'expireds.exp_id')
            ->join('consigned_details', 'expired_items.item_id', '=', 'consigned_details.item_id')
            ->join('suppliers', 'expireds.supp_id', '=', 'suppliers.supp_id')
            ->join('users', 'expireds.userid', '=', 'users.userid')
            ->select([
                'expireds.exp_id',
                'expireds.access_date',
                'expireds.supp_id',
                'expireds.userid',
                'suppliers.company',
                'suppliers.address',
                'users.username',
                'users.role',
                'expired_items.exp_no',
                'expired_items.item_id',
                'expired_items.quantity',
                'consigned_details.barcode',
                'consigned_details.particulars',
            ])
            ->get();

        $suppliers = Supplier::select(['supp_id', 'company'])
            ->orderBy('company')
            ->get();

        return Inertia::render('ExpiredItems', [
            'expiredItems' => $expiredItems,
            'suppliers' => $suppliers,
        ]);
    }
}
