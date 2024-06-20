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
        Schema::create('client_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index();
            $table->integer('clinic_id')->index();
            $table->boolean('has_history');
            $table->text('history');
            $table->text('disease');
            $table->boolean('has_disease');
            $table->text('allergy');
            $table->boolean('has_allergy');
            $table->text('previous_treatments');
            $table->boolean('had_previous_treatments');
            $table->text('medication');
            $table->boolean('has_medication');
            $table->string('occupation');
            $table->string('video_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_forms');
    }
};
