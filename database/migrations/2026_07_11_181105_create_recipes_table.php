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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('featured_image');
            $table->json('gallery_images')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('category');
            $table->enum('difficulty', ['Easy', 'Medium', 'Hard'])->default('Medium');
            $table->enum('diet_type', ['Vegetarian', 'Non-Vegetarian', 'Vegan'])->default('Vegetarian');
            $table->enum('spice_level', ['Mild', 'Medium', 'Hot'])->default('Medium');
            $table->string('duration');
            $table->enum('status', ['Draft', 'Published', 'Featured'])->default('Draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
