<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['name', 'ktp', 'sim', 'gender', 'umur', 'phone', 'sallary', 'joindate', 'photo', 'address'];

    public function sallaries()
    {
        return $this->hasMany(Sallary::class);
    }
}
