<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('agenda_actividades', function (Blueprint $table) {
            $table->id();

            $table->foreignId('agenda_desplazamiento_id')
                ->constrained('agendas_desplazamiento')
                ->cascadeOnDelete();

            $table->date('fecha_reporte');
            $table->string('ruta_ida');
            $table->string('ruta_regreso');

            $table->json('medios_transporte')->nullable();
            $table->text('actividades_ejecutar');
            $table->text('desplazamientos_internos')->nullable();
            $table->text('observaciones')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agenda_actividades');
    }
};
