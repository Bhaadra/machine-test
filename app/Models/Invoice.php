<?php
// Invoice.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table='Invoice';

        protected $fillable = [
            'product_id',
            'customer_id',
            'quantity',
            'price',
            'total_amount',
        ];
        public function product()
        {
            return $this->belongsTo(Product::class);
        }
    
        public function customer()
        {
            return $this->belongsTo(Customer::class);
        }
}
