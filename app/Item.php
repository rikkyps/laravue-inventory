<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;

class Item extends Model
{
    use AutoNumberTrait;

    public function getAutoNumberOptions()
    {
        return [
            'barcode' => [
                'length' => 8 // The number of digits in an autonumber
            ]
        ];
    }

    protected $fillable = ['supplier_id', 'category_id', 'name', 'barcode', 
                            'root', 'buyPrice', 'sellPrice', 'buyDate', 'image', 'qty'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
