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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();

            $table->text('title')->nullable();
            $table->longText('description_one')->nullable();
            $table->longText('description_tow')->nullable();

            $table->string('slug')->unique();
            $table->boolean('status')->default(0);
            $table->integer('order')->default(0);

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
        Schema::dropIfExists('pages');
    }
};
