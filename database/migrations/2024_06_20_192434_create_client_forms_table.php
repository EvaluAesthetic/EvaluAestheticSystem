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
            $table->foreignId('client_id')->index();
            $table->boolean('has_history')->default(false);
            $table->text('history')->nullable();
            $table->text('disease')->nullable();
            $table->boolean('has_disease')->default(false);
            $table->text('allergy')->nullable();
            $table->boolean('has_allergy')->default(false);
            $table->text('previous_treatments')->nullable();
            $table->boolean('had_previous_treatments')->default(false);
            $table->text('medication')->nullable();
            $table->boolean('has_medication')->default(false);
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
