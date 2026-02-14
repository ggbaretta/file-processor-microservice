<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\FileProcessorService;
use Illuminate\Http\Request;

class ImportController extends Controller {
    public function store(Request $request, FileProcessorService $service) {
        $request->validate(['file' => 'required|mimes:csv,txt']);
        $path = $request->file('file')->store('imports');
        $service->process($path);
        return response()->json(['message' => 'Arquivo em processamento!'], 202);
    }
}