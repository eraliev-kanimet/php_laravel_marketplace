<?php

namespace App\Models\Users;

use App\Models\Product\ProductTemplate;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

/**
 * @method static create(string[] $array)
 * @property BelongsToMany $roles
 * @property int $id
 */
class User extends Authenticatable
{
    use HasApiTokens;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)->using(RoleUser::class);
    }

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(ProductTemplate::class);
    }
}
