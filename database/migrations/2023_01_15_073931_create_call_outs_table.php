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
        Schema::dropIfExists('call_outs');

        Schema::create('call_outs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nurse_id')->nullable()->constrained();
            $table->foreignId('school_id')->constrained();
            $table->dateTime('from')->nullable();
            $table->dateTime('to')->nullable();
            $table->tinyInteger('confirmed')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('call_outs');
    }
};
