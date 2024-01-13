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

        Schema::create('solicitudcreditos', function (Blueprint $table) {
            $table->id();
            $table->integer('cliente_id'); // a. Cliente que solicita
            $table->decimal('valor_credito', 10, 2);  // b. Valor de crédito que solicita
            $table->integer('cuotas'); // c. Cuotas que solicita
            $table->text('descripcion')->nullable(); // d. Descripción
            $table->string('estado')->nullable(); // e. Estado de la solicitud
            $table->date('fecha_solicitud'); // f. Fecha de solicitud
            $table->integer('tipo_credito_id'); // g. Tipo de crédito
            $table->text('observaciones_asesor')->nullable(); // h. Observaciones del asesor
            $table->timestamps();

            // Definir relaciones con otras tablas si es necesario
          //  $table->foreign('cliente_id')->references('id')->on('clientes');
          //  $table->foreign('tipo_credito_id')->references('id')->on('tipocreditos');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudcreditos');
    }
};
