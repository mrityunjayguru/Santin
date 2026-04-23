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
        Schema::create('art', function (Blueprint $table) {
            $table->id();
            $table->string('art_id');
            $table->string('artist')->nullable();
            $table->string('title')->nullable();
            $table->string('type')->nullable();
            $table->string('size')->nullable();
            $table->string('frame')->nullable();
            $table->date('date')->nullable();
            $table->string('location')->nullable();
            $table->string('ownership')->nullable();
            $table->string('inventory_status')->nullable();
            $table->bigInteger('bundle')->nullable();
            $table->bigInteger('pkg_quantity')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('art');
    }
};
