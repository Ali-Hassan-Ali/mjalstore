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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();

            $table->double('quantity')->default(0);
            $table->double('balance')->default(0);
            $table->integer('rating')->nullable();
            $table->double('count_of_buy')->default(0);
            $table->double('price');

            $table->string('slug')->unique()->nullable();
            $table->boolean('status')->default(0);

            $table->foreignId('category_id')->constrained();
            $table->foreignId('market_id')->constrained()->nullable();
            $table->foreignId('admin_id')->constrained();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
