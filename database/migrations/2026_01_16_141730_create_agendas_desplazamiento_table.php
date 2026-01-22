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
        Schema::create('agendas_desplazamiento', function (Blueprint $table) {
            

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('nombre_completo');
            $table->string('tipo_documento', 5);
            $table->string('numero_documento', 50);

            $table->date('fecha_elaboracion');
            $table->unsignedBigInteger('numero_contrato');
            $table->unsignedSmallInteger('anio_contrato');
            $table->date('fecha_vencimiento');

            $table->string('cargo', 50);
            $table->text('objetivo_contractual');

            $table->string('direccion_general', 50);
            $table->string('dependencia_centro', 100);

            // Ruta y destino
            $table->string('ruta', 255);
            $table->string('municipio_destino', 100);
            $table->string('ciudad_destino', 100);

            //Entidad / contacto
            $table->string('entidad_empresa', 120);
            $table->string('contacto', 120);

            //Fechas desplazamiento
            $table->date('fecha_inicio_desplazamiento');
            $table->date('fecha_fin_desplazamiento');

            //Objetivo desplazamiento
            $table->text('objetivo_desplazamiento');

            $table->json('obligaciones_contrato')->nullable();


            $table->string('firma_contratista')->nullable();
            $table->string('firma_supervisor')->nullable();
            $table->string('firma_ordenador')->nullable();

            $table->enum('estado', [
                'BORRADOR',
                'ENVIADA',
                'FIRMADA_SUPERVISOR',
                'FIRMADA_ORDENADOR'
            ])->default('BORRADOR');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendas_desplazamiento');
    }
};
