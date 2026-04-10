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
            $table->string('brand')->nullable()->after('category_id');
            $table->string('model')->nullable()->after('brand');
            $table->string('origin')->nullable()->after('model');
            $table->string('assembly')->nullable()->after('origin');
            $table->string('warranty')->nullable()->after('assembly');
            $table->longText('features')->nullable()->after('description');
            $table->string('catalog')->nullable()->after('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['brand', 'model', 'origin', 'assembly', 'warranty', 'features', 'catalog']);
        });
    }
};
