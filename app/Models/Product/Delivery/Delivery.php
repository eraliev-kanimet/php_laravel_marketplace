<?php

namespace App\Models\Product\Delivery;

use App\Models\Product\ProductTemplate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $data)
 * @property int $id
 * @property bool $free
 * @property bool $fitting
 * @property int $return
 */
class Delivery extends Model
{
    /**
     * @var string
     */
    protected $table = 'delivery';

    /**
     * @var string[]
     */
    protected $fillable = [
        'free',
        'fitting',
        'return'
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
