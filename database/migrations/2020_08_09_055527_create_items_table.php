<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ingredients');
            $table->string('image_url');
            $table->float('price', 5, 2);
            $table->enum('size', ["small", "medium", "large"])->default("medium");
            $table->enum('currency', ["USD", "EUR"])->default("EUR");
            $table->enum("status", ["available", "unavailable"])->default('available');;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
}
