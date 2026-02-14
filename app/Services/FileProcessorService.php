<?php

namespace App\Services;

use App\Jobs\ProcessCsvLine;
use Illuminate\Support\Facades\Storage;

class FileProcessorService {
    public function process(string $filePath): void {
        $path = Storage::path($filePath);
        if (($handle = fopen($path, 'r')) !== false) {
            $header = fgetcsv($handle);
            while (($line = fgetcsv($handle)) !== false) {
                $data = array_combine($header, $line);
                ProcessCsvLine::dispatch($data)->onQueue('imports');
            }
            fclose($handle);
        }
    }
}