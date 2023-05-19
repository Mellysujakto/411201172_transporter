<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kurir extends Model
{
    protected $table = 'kurir';
    protected $fillable = ['id', 'name', 'email', 'password', 'api_token'];
    const CREATED_AT = null;
    const UPDATED_AT = null;
}
