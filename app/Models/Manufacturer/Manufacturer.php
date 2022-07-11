<?php

namespace App\Models\Manufacturer;

use App\Models\Product\ProductTemplate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $name
 */
class Manufacturer extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'image'
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
        return $this->hasMany(ProductTemplate::class);
    }
}
