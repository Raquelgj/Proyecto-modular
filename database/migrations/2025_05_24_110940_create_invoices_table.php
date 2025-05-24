<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('invoices', function (Blueprint $table) {
        $table->id();
        $table->foreignId('order_id')->constrained()->cascadeOnDelete();
        $table->string('invoice_number')->unique();
        $table->date('invoice_date');
        $table->string('pdf_path'); // ruta al PDF generado
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
   public function down()
{
    Schema::dropIfExists('invoices');
}

};
