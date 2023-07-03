<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $primaryKey = 'sale_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date_issued',
        'cust_id',
        'userid',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cust_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function saleDetails()
    {
        return $this->hasMany(SalesDetail::class, 'sale_id');
    }
}
