<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pos extends Model
{
    protected $fillable = ['item_id', 'name', 'qty', 'price', 'subTotal'];
    protected $table = 'pos';

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

}
