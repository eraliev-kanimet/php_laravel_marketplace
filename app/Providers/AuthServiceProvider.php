<?php

namespace App\Providers;

use App\Models\Manufacturer\Manufacturer;
use App\Models\Product\Color\Color;
use App\Models\Product\Product;
use App\Models\Product\Size\Size;
use App\Policies\ColorPolicy;
use App\Policies\ManufacturerPolicy;
use App\Policies\ProductsPolicy;
use App\Policies\SizePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $policies = [
        Size::class => SizePolicy::class,
        Color::class => ColorPolicy::class,
        Manufacturer::class => ManufacturerPolicy::class,
        Product::class => ProductsPolicy::class,
    ];

    /**
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
