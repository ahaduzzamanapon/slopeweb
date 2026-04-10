<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'brand')) {
                $table->string('brand')->nullable();
            }
            if (!Schema::hasColumn('products', 'model')) {
                $table->string('model')->nullable();
            }
            if (!Schema::hasColumn('products', 'origin')) {
                $table->string('origin')->nullable();
            }
            if (!Schema::hasColumn('products', 'assembly')) {
                $table->string('assembly')->nullable();
            }
            if (!Schema::hasColumn('products', 'warranty')) {
                $table->string('warranty')->nullable();
            }
            if (!Schema::hasColumn('products', 'features')) {
                $table->text('features')->nullable();
            }
            if (!Schema::hasColumn('products', 'catalog')) {
                $table->string('catalog')->nullable();
            }
            if (!Schema::hasColumn('products', 'installation_charge')) {
                $table->decimal('installation_charge', 10, 2)->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['brand', 'model', 'origin', 'assembly', 'warranty', 'features', 'catalog', 'installation_charge']);
        });
    }
};
