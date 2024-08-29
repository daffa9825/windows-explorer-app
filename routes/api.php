<?php

use App\Http\Controllers\FolderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(FolderController::class)->group(function () {
    Route::get('{folder_id}/sub_folder', 'listSubfolder');
    Route::get('folder', 'listFolder');
});

