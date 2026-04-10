<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quotations', function (Blueprint $table) {
            $table->string('ref_id')->nullable()->after('title');
            $table->string('client_name')->nullable()->after('ref_id');
            $table->string('client_address')->nullable()->after('client_name');
            $table->string('client_phone')->nullable()->after('client_address');
            $table->string('prepared_by')->nullable()->after('client_phone');
        });
    }

    public function down(): void
    {
        Schema::table('quotations', function (Blueprint $table) {
            $table->dropColumn(['ref_id', 'client_name', 'client_address', 'client_phone', 'prepared_by']);
        });
    }
};
