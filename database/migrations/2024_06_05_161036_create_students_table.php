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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('annual_study');
            $table->string('registration_number');
            $table->tinyInteger('class_level_proposed');
            $table->string('name');
            $table->string('nickname')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('mother_tongue')->nullable();
            $table->string('status_in_the_family')->nullable();
            $table->tinyInteger('pupil_position')->nullable();
            $table->tinyInteger('sex')->nullable();
            $table->tinyInteger('religion')->nullable();
            $table->string('nationality')->nullable();
            $table->tinyInteger('numbers_of_siblings')->nullable();
            $table->string('previous_school_name')->nullable();
            $table->string('previous_school_city_name')->nullable();
            $table->string('previous_school_country_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
