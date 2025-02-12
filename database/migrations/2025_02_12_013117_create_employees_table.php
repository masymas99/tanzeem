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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            $table->enum('gender', ['male', 'female']);
            $table->date('dob');
            $table->string('nationality');
            $table->string('position');
            $table->string('nid_number');
            $table->date('joining_date');
            $table->integer('salary');
            $table->time('work_start_time')->default('09:00:00');
            $table->time('work_end_time')->default('16:00:00');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
