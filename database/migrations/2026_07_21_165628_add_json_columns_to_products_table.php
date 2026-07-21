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
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'kit_items')) {
                $table->json('kit_items')->nullable();
            }
            if (!Schema::hasColumn('products', 'features')) {
                $table->json('features')->nullable();
            }
            if (!Schema::hasColumn('products', 'ingredients_list')) {
                $table->json('ingredients_list')->nullable();
            }
            if (!Schema::hasColumn('products', 'nutrition_info')) {
                $table->json('nutrition_info')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['kit_items', 'features', 'ingredients_list', 'nutrition_info']);
        });
    }
};
