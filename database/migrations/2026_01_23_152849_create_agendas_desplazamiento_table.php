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
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
        $table->string('nombre_completo');
        $table->string('tipo_documento')->nullable();
        $table->string('numero_documento')->nullable();
        $table->string('cargo')->nullable();
        $table->string('numero_contrato')->nullable();
        $table->integer('anio_contrato')->nullable();
        $table->date('fecha_elaboracion')->nullable();
        $table->date('fecha_vencimiento')->nullable();
        $table->text('objetivo_contractual')->nullable();
        $table->string('municipio_destino');
        $table->string('ruta')->nullable();
        $table->string('ciudad_destino')->nullable();
        $table->string('entidad_empresa')->nullable();
        $table->string('contacto')->nullable();
        $table->date('fecha_inicio_desplazamiento');
        $table->date('fecha_fin_desplazamiento');
        $table->string('objetivo_desplazamiento')->nullable();
        $table->string('direccion_general')->nullable();
        $table->string('dependencia_centro')->nullable();
        $table->json('obligaciones_contrato')->nullable();
        $table->string('firma_contratista')->nullable();
        $table->string('firma_supervisor')->nullable();
        $table->string('firma_ordenador')->nullable();
        $table->string('estado')->default('ENVIADA');
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
