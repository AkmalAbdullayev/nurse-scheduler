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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('building_code');
            $table->string('district');
            $table->text('primary_dbn');
            $table->text('school_name');
            $table->text('street_address_1');
            $table->text('street_address_2')->nullable();
            $table->string('city');
            $table->foreignId('state_id')->constrained();
            $table->bigInteger('zip_code')->nullable();
            $table->foreignId('assigned_rn')->nullable()->constrained('nurses'); // assigned registered nurse email
            $table->string('email')->nullable();
            $table->foreignId('borough_id')->nullable()->constrained();
            $table->string('school_phone')->nullable();
            $table->text('google_map')->nullable();
            $table->foreignId('principal_id')->nullable()->constrained('school_principals');
            $table->text('special_notes')->nullable();
            $table->tinyText('assignment_priority')->nullable();

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
        Schema::dropIfExists('schools');
    }
};
