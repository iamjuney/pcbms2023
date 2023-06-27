<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'prod_id';

    protected $fillable = [
        'prod_name',
        'shelf_life',
        'unit',
        'appreciation',
        'max_lvl'
    ];

    protected $casts = [
        'shelf_life' => 'integer',
        'max_lvl' => 'integer',
        'appreciation' => 'decimal:2',
    ];

    public const UNIT_PIECE = 'piece';
    public const UNIT_PACK = 'pack';
    public const UNIT_BOTTLE = 'bottle';
    public const UNIT_BAG = 'bag';

    public static function getAvailableUnits(): array
    {
        return [
            self::UNIT_PIECE,
            self::UNIT_PACK,
            self::UNIT_BOTTLE,
            self::UNIT_BAG,
        ];
    }
}
