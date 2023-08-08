<?php

namespace App\helpers\Services;

use App\helpers\Interfaces\Actions;
use Illuminate\Foundation\Bus\PendingDispatch;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

final class FileManager implements Actions
{
    /**
     * @param string $format
     */
    public function __construct(private readonly string $format = 'xlsx')
    {
    }

    /**
     * @param object $class
     * @param string $filename
     * @return BinaryFileResponse
     */
    public function export(object $class, string $filename): BinaryFileResponse
    {
        return Excel::download(
            export: $class,
            fileName: $filename . '.' . $this->format
        );
    }

    /**
     * @param object $class
     * @param string $filename
     * @return \Maatwebsite\Excel\Excel
     */
    public function importXlsx(object $class, string $filename): \Maatwebsite\Excel\Excel
    {
        return Excel::import(
            import: $class,
            filePath: $filename,
            readerType: \Maatwebsite\Excel\Excel::XLSX
        );
    }

    /**
     * @param object $class
     * @param string $filename
     * @return \Maatwebsite\Excel\Excel
     */
    public function importXls(object $class, string $filename): \Maatwebsite\Excel\Excel
    {
        return Excel::import(
            import: $class,
            filePath: $filename,
            readerType: \Maatwebsite\Excel\Excel::XLS
        );
    }

    /**
     * @param object $class
     * @param string $filename
     * @return \Maatwebsite\Excel\Excel
     */
    public function importCsv(object $class, string $filename): \Maatwebsite\Excel\Excel
    {
        return Excel::import(
            import: $class,
            filePath: $filename,
            readerType: \Maatwebsite\Excel\Excel::CSV
        );
    }

    /**
     * @param object $class
     * @param string $filename
     * @param string $extension
     * @return PendingDispatch
     */
    public function queuedImport(object $class, string $filename, string $extension): PendingDispatch
    {
        return Excel::queueImport(
            import: $class,
            filePath: $filename,
            readerType: $extension
        );
    }
}
