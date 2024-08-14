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
        Schema::table('client_forms', function (Blueprint $table) {
            $table->text('treatment_wishes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client_forms', function (Blueprint $table) {
            $table->dropColumn('treatment_wishes');
        });
    }
};
