<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsignedProduct extends Model
{
    use HasFactory;

    protected $primaryKey = 'cp_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'supp_id',
        'userid',
        'date_received',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supp_id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }
}
