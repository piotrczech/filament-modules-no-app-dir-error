<?php

use Illuminate\Support\Facades\Route;
use Modules\MyModule\Http\Controllers\MyModuleController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('mymodules', MyModuleController::class)->names('mymodule');
});
