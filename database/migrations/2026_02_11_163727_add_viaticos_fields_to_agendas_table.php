<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('agendas_desplazamiento', function (Blueprint $table) {
            // Añadimos los campos que el error SQL dice que faltan
            $table->decimal('valor_viaticos', 15, 2)->nullable()->after('estado');
            $table->text('observaciones_finanzas')->nullable()->after('valor_viaticos');
        });
    }

    public function down(): void
    {
        Schema::table('agendas_desplazamiento', function (Blueprint $table) {
            $table->dropColumn(['valor_viaticos', 'observaciones_finanzas']);
        });
    }
};