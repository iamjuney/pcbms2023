<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsignedDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'item_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cp_id',
        'prod_id',
        'barcode',
        'particulars',
        'expiry_date',
        'unit_price',
        'selling_price',
        'quantity',
        'amount',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function consignedProduct()
    {
        return $this->belongsTo(ConsignedProduct::class, 'cp_id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'prod_id');
    }
}
