<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::table('products', function (Blueprint $table) {
        //     // Eliminar la restricción de clave foránea
        //     $table->dropForeign(['category_id']);
        // });
    }
    
    public function down(): void
    {
    //     Schema::table('products', function (Blueprint $table) {
    //         // Si se revierte la migración, restaurar la clave foránea
    //         $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
    //     });
    // }
    }
};
