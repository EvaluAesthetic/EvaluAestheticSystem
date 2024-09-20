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
            $table->dropColumn('disease');
            $table->dropColumn('has_disease');

            $table->boolean('is_pregnant_or_breastfeeding')->default(false);
            $table->text('pregnancy_details')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client_forms', function (Blueprint $table) {
            $table->text('disease')->nullable();
            $table->boolean('has_disease')->default(false);

            $table->dropColumn('is_pregnant_or_breastfeeding');
            $table->dropColumn('pregnancy_details');
        });
    }
};
