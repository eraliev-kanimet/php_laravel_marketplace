<?php

namespace App\Models\Product;

use App\Models\Product\Color\Color;
use App\Models\Product\Size\Size;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property ProductTemplate $product
 */
class Product extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'product_id',
        'size_id',
        'color_id',
        'images',
        'status',
        'price',
        'delivery',
        'discount',
        'stock'
    ];

    protected $casts = [
        'images' => 'array'
    ];

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(ProductTemplate::class);
    }

    /**
     * @return BelongsTo
     */
    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class);
    }

    /**
     * @return BelongsTo
     */
    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }
}
