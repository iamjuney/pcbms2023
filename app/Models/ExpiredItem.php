<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpiredItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'exp_no';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'exp_id',
        'item_id',
        'quantity',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function expired()
    {
        return $this->belongsTo(Expired::class, 'exp_id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function consignedDetail()
    {
        return $this->belongsTo(ConsignedDetail::class, 'item_id');
    }
}
