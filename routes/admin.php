<?php

use App\Http\AdminControllers\CategoriesController;
use App\Http\AdminControllers\ColorsController;
use App\Http\AdminControllers\DeliveriesController;
use App\Http\AdminControllers\ManufacturersController;
use App\Http\AdminControllers\SizesController;
use Illuminate\Support\Facades\Route;

Route::apiResource('categories', CategoriesController::class);
Route::apiResource('sizes', SizesController::class)->except(['show']);
Route::apiResource('colors', ColorsController::class)->except(['show']);
Route::apiResource('manufacturers', ManufacturersController::class)->except(['show']);
Route::apiResource('deliveries', DeliveriesController::class)->except(['show']);