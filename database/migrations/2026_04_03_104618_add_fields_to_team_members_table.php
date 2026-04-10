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
        Schema::table('team_members', function (Blueprint $table) {
            if (!Schema::hasColumn('team_members', 'name')) {
                $table->string('name')->nullable();
                $table->string('designation')->nullable();
                $table->string('type')->nullable()->comment('management, engineer, etc');
                $table->string('image')->nullable();
                $table->integer('order')->default(0);
                $table->boolean('active')->default(true);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('team_members', function (Blueprint $table) {
            $table->dropColumn(['name', 'designation', 'type', 'image', 'order', 'active']);
        });
    }
};
