<?php 

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

Route::get('/download-log', function () {
    $path = storage_path('logs/laravel.log');
    if (!file_exists($path)) {
        abort(404, "Log file not found.");
    }
    return Response::download($path);
});

Route::get('/view-log', function () {
    $path = storage_path('logs/laravel.log');
    if (!file_exists($path)) {
        abort(404, "Log file not found.");
    }

    $logContent = file_get_contents($path);

    // If the file is large, display it in chunks
    if (!$logContent) {
        abort(500, "Unable to read the log file.");
    }

    // nl2br to maintain line breaks in HTML
    return nl2br(e($logContent));
});