<?php

namespace App\Models\Product\Color;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed $name
 * @property mixed $color
 * @property mixed $id
 * @method static create(array $array)
 */
class Color extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'color'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
