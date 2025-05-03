<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;  // Esta es la importación correcta
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;  // Asegúrate de que HasFactory esté aquí

    protected $fillable = [
        'user_id',
        'total_price',
        'status',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function user()
{
    return $this->belongsTo(User::class);
}

public function product()
{
    return $this->belongsTo(Product::class);  
}

}
