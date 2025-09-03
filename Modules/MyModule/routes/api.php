<?php

use Illuminate\Support\Facades\Route;
use Modules\MyModule\Http\Controllers\MyModuleController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('mymodules', MyModuleController::class)->names('mymodule');
});
