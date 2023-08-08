<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        if (Schema::hasColumn('nurses', 'user_id')) {
            Schema::table('nurses', function (Blueprint $table) {
                $table->dropColumn('user_id');
            });
        }

        Schema::table('nurses', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->nullable()
                ->after('assigned_date')
                ->constrained()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('nurses', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
};
