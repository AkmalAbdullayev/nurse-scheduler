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
        Schema::table('call_outs', function (Blueprint $table) {
            $table->string('created_by_role')->nullable();
            $table->text('special_notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('call_outs', function (Blueprint $table) {
            $table->dropColumn('created_by_role');
        });
    }
};
