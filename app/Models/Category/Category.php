<?php

namespace App\Models\Category;

use App\Models\Product\ProductTemplate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static whereNull(string $string)
 * @property int $id
 */
class Category extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'category_id',
        'name',
        'image'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(self::class);
    }

    /**
     * @return HasMany
     */
    public function categories(): HasMany
    {
        return $this->hasMany(self::class);
    }

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(ProductTemplate::class);
    }
}
