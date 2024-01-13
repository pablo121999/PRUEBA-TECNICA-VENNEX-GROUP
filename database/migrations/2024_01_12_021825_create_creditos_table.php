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
        Schema::create('creditos', function (Blueprint $table) {
            $table->id();
            $table->string('numero_cuenta')->unique()->nullable();
            $table->decimal('valor_credito', 10, 2);
            $table->integer('numero_cuotas')->unsigned();
            $table->decimal('valor_cuota', 10, 2);
            $table->integer('cliente_id');
            $table->dateTime('fecha_aprobacion')->nullable();
            $table->integer('quien_aprobo_id')->nullable();
            $table->integer('tipo_credito_id');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creditos');
    }
};
