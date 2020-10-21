<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['customer_id', 'qty', 'subTotal', 'vat', 'grandTotal', 'amount', 'due', 'payMethod',
                            'orderDate', 'orderMonth', 'orderYear'];
    
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->belongsToMany('App\Item', 'item_sale', 'sale_id', 'item_id')->withPivot('qty', 'price', 'subTotal');
    }
}
