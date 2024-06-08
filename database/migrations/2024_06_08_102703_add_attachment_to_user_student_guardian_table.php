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
        Schema::table('users', function (Blueprint $table) {
            $table->string('attachment')->after('password')->nullable();
        });
        Schema::table('students', function (Blueprint $table) {
            $table->string('attachment')->after('previous_school_country_name')->nullable();
        });
        Schema::table('guardians', function (Blueprint $table) {
            $table->string('attachment')->after('authorized_to_pickup_pupil')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('attachment');
        });
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('attachment');
        });
        Schema::table('guardians', function (Blueprint $table) {
            $table->dropColumn('attachment');
        });
    }
};
