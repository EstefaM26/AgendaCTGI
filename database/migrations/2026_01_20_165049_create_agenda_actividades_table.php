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

            $table->string('ruta_ida', 150);
            $table->string('ruta_regreso', 150);

            $table->json('medios_transporte');

            $table->text('actividades_ejecutar');
            $table->string('desplazamientos_internos', 150)->nullable();

            $table->string('observaciones', 255)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agenda_actividades');
    }
};
