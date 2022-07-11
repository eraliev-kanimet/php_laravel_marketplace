<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RoleUser extends Pivot
{
    /**
     * @var bool
     */
    public $timestamps = false;
}
