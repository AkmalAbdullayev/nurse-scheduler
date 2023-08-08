<?php

use App\Enums\CallOutStatuses;
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
            $table->string('status')->after('to')->default(CallOutStatuses::PENDING_ACCEPTANCE->name);
            $table->integer('created_by_id')->nullable()->after('confirmed');
            $table->string('created_by_str')->nullable()->after('confirmed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('call_outs', function (Blueprint $table) {
            //
        });
    }
};
