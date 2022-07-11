<?php

namespace App\Models\Product\Size;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $array)
 * @property int $id
 * @property string $name
 * @property array|string $description
 */
class Size extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'description' => 'array'
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
