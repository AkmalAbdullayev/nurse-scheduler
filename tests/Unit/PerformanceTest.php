<?php

namespace Tests\Unit;

use App\Models\History;
use Illuminate\Support\Benchmark;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PerformanceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example(): void
    {
        Cache::shouldReceive('get')
            ->once()
            ->with('histories')
            ->andReturn('value');

        $response = $this->get('/admin');

//        Benchmark::dd(fn() => History::query()->paginate(10));
    }
}
