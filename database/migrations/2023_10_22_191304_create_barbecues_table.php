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
        Schema::create('barbecues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id')->constrained('users')->onDelete('CASCADE');
            $table->string('title');
            $table->dateTime('date');
            $table->float('value_with_drink')->default(0);
            $table->float('value_without_drink')->default(0);
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barbecues');
    }
};
