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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('title_card')->nullable();

            $table->string('logo')->nullable();
            $table->string('banner')->nullable();

            $table->string('slug')->unique()->nullable();
            $table->string('parent_id')->nullable();

            $table->boolean('status')->default(0);
            $table->boolean('has_market')->default(0);

            $table->string('color_1')->nullable();
            $table->string('color_2')->nullable();
            $table->longText('description')->nullable();

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
        Schema::dropIfExists('categories');
    }
};
