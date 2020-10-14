<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sallary extends Model
{
    protected $fillable = ['employee_id', 'amount', 'sallaryDate', 'sallaryMonth', 'sallaryYear'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
