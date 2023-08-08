<?php

namespace App\Jobs;

use App\helpers\Services\FileManager;
use App\Imports\NursesImport;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Excel;

class ProcessFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private readonly string $file)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws Exception
     */
    public function handle(): void
    {
        $fileManager = new FileManager();

        $extension = explode('.', $this->file);

        match (end($extension)) {
            'csv' => $fileManager->importCsv(
                class: new NursesImport(),
                filename: $this->file
            ),
            'xlsx' => $fileManager->importXlsx(
                class: new NursesImport(),
                filename: $this->file
            ),
            'xls' => $fileManager->importXls(
                class: new NursesImport(),
                filename: $this->file
            ),
        };
    }
}
