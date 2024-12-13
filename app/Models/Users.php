<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class Users extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $fillable = [
        "email",
        "password",
        "first_name",
        "last_name",
        "birthday",
        "gender",
        "accessibility",
        "deleted_at",
    ];
}
