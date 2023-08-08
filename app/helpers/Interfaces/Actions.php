<?php

namespace App\helpers\Interfaces;

interface Actions
{
    public function export(object $class, string $filename): mixed;

    public function importXlsx(object $class, string $filename): mixed;

    public function queuedImport(object $class, string $filename, string $extension): mixed;

    public function importCsv(object $class, string $filename): mixed;

    public function importXls(object $class, string $filename): mixed;
}
