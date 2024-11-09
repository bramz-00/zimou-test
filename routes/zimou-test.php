<?php

use App\Exports\PackagesExport;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Maatwebsite\Excel\Excel;


Route::middleware('auth')->group(function () {


    Route::get('/packages', [PackageController::class,'index'])->name('package.index');
    Route::get('/packages/fetch', [PackageController::class,'fetch'])->name('package.fetch');

    Route::get('/export-package-excel',[PackageController::class,'exportExcel'])->name('packages.export.excel');
    Route::get('/export-package-csv',[PackageController::class,'exportCSV'])->name('packages.export.csv');

});
