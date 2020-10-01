<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['name', 'ktp', 'sim', 'gender', 'umur', 'phone', 'joindate', 'photo', 'address'];
}
