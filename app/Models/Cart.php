<?php
// app/Models/Cart.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // Si la tabla en la base de datos no se llama "carts", puedes especificar el nombre de la tabla aquí
    protected $table = 'carts';

    // Si no usas los campos 'created_at' y 'updated_at', puedes deshabilitarlos
    public $timestamps = false;

    // Define los atributos que pueden ser asignados de forma masiva
    protected $fillable = ['name', 'quantity', 'price'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con el modelo Product (suponiendo que tengas un modelo Product)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
