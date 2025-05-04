<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Agrega aquí los campos que deseas permitir para la asignación masiva
    protected $fillable = [
        'name',        // El nombre del producto
        'description', // La descripción del producto
        'price',       // El precio del producto
        'stock',       // El stock del producto
        'image',       // La imagen del producto (si aplica)
    ];
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
}
