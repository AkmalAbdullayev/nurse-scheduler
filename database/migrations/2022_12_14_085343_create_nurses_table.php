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
        Schema::create('nurses', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('mi')->nullable();
            $table->string('last_name')->nullable();
            $table->text('street_address_1')->nullable();
            $table->text('street_address_2')->nullable();
            $table->foreignId('city_id')->constrained();
            $table->foreignId('state_id')->nullable()->constrained();
            $table->bigInteger('zip_code')->nullable();
            $table->string('email');
            $table->string('cell_number')->unique();
            $table->string('license_number')->nullable();
            $table->text('special_notes')->nullable();
            $table->boolean('active_for_assignments')->nullable();
            $table->dateTime('assigned_date')->nullable()->default(now());

            $table->softDeletes();
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
        Schema::dropIfExists('nurses');
    }
};
