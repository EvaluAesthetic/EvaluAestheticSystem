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
        Schema::table('evaluations', function (Blueprint $table) {
            $table->foreign('client_form_id')->references('id')->on('client_forms')->onDelete('cascade');
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
            $table->foreign('professional_id')->references('id')->on('professionals')->onDelete('set null');
        });

        Schema::table('client_forms', function (Blueprint $table) {
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluations', function (Blueprint $table) {
            $table->dropForeign(['client_form_id']);
            $table->dropForeign(['clinic_id']);
            $table->dropForeign(['professional_id']);
        });
        Schema::table('client_forms', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
        });
    }
};
