<?php

namespace Tests\Unit;

use App\Enums\CallOutStatuses;
use App\Models\CallOut;
use App\Models\Nurse;
use App\Models\School;
use Grpc\Call;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_benchmark_performance(): void
    {
        $callOut = CallOut::query()->get()->where('status', '=', CallOutStatuses::PENDING_ACCEPTANCE);

        $school = School::query()->has('medical_needs')->whereIn('id', $callOut->map->school_id)->get();

        dd($school->isNotEmpty());
    }
}
