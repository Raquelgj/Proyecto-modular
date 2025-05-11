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
        //     $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null'); // Agregar la columna category_id
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    //     Schema::table('products', function (Blueprint $table) {
    //         $table->dropColumn('category_id'); // Eliminar la columna category_id si se revierte la migración
    //     });
    // }
    }
};
