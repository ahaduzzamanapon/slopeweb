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
            if (!Schema::hasColumn('products', 'installation_charge')) {
                $table->decimal('installation_charge', 10, 2)->nullable()->after('catalog');
            }
        });

        Schema::table('general_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('general_settings', 'md_name')) {
                $table->string('md_name')->nullable();
                $table->string('signature')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['installation_charge']);
        });

        Schema::table('general_settings', function (Blueprint $table) {
            $table->dropColumn(['md_name', 'signature']);
        });
    }
};
