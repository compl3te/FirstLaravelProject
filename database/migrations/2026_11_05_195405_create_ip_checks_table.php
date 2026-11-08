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
        Schema::create('ip_checks', function (Blueprint $table) {
            $table->id();
            $table->string('ip');
            $table->string('country')->nullable();
            $table->string('organization')->nullable();
            $table->string('netname')->nullable();
            $table->string('ip_range')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ip_checks');
    }
};
