<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            
            $table->string('currency')->default('EGP')->after('desD');

            $table->integer('tax_percentage')->default(10)->after('currency');
        });
    }

    /**
     
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['currency', 'tax_percentage']);
        });
    }
};
