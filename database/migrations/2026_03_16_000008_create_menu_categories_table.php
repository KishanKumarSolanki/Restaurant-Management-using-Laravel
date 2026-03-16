<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menu_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::table('items', function (Blueprint $table) {
            $table->foreignId('menu_category_id')->nullable()->after('category')->constrained('menu_categories')->nullOnDelete();
        });

        $existingCategories = DB::table('items')
            ->select('category')
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category')
            ->filter();

        foreach ($existingCategories as $categoryName) {
            $categoryId = DB::table('menu_categories')->insertGetId([
                'name' => $categoryName,
                'description' => $categoryName . ' items',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('items')
                ->where('category', $categoryName)
                ->update(['menu_category_id' => $categoryId]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropConstrainedForeignId('menu_category_id');
        });

        Schema::dropIfExists('menu_categories');
    }
};
