<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
  
    protected $fillable= [
        'name',
        'quantity',
        'price',
        'description',
        'category'
    ];

    // Product.php

    public function invoices()
    {
        return $this->belongsToMany(Invoice::class)->withPivot('quantity');
    }

}
