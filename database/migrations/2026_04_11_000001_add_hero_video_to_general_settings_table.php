<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->string('hero_video')->nullable()->after('hero_image');

            // Extended social links are stored in json 'social_links' already
            // but adding explicit youtube column for completeness — optional,
            // we'll rely on the JSON column.
        });
    }

    public function down(): void
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->dropColumn('hero_video');
        });
    }
};
