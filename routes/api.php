<?php

use App\Http\Controllers\ParentFolderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::controller(ParentFolderController::class)->group(function () {
    Route::get('parent_folders', 'listParentFolder');
});
