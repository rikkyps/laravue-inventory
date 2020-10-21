<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'address', 'photo'];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
