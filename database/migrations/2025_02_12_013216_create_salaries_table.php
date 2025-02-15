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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->integer('salary');
            $table->integer('total_attendance');
            $table->integer('total_absence')->default(0);
            $table->integer('total_overtime_hours')->default(0);
            $table->integer('total_deduction_hours')->default(0);
            $table->integer('total_overtime')->default(0);
            $table->integer('total_deduction')->default(0);
            $table->integer('net_salary')->default(0);
        


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
