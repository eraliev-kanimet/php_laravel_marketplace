<?php

namespace App\Models\Product;

use App\Models\Category\Category;
use App\Models\Manufacturer\Manufacturer;
use App\Models\Product\Delivery\Delivery;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $user_id
 */
class ProductTemplate extends Model
{
    /**
     * @var string
     */
    protected $table = 'product';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'properties',
        'category_id',
        'manufacturer_id',
        'user_id',
        'delivery_id'
    ];

    protected $casts = [
        'properties' => 'array'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsTo
     */
    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
    }

    /**
     * @return BelongsTo
     */
    public function delivery(): BelongsTo
    {
        return $this->belongsTo(Delivery::class);
    }
}
