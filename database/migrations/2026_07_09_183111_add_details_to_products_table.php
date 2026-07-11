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
            $table->decimal('rating', 3, 1)->default(4.5)->after('is_out_of_stock');
            $table->integer('reviews_count')->default(120)->after('rating');
            $table->text('ingredients')->nullable()->after('reviews_count');
            $table->string('weight')->nullable()->after('ingredients');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['rating', 'reviews_count', 'ingredients', 'weight']);
        });
    }
};
