<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;



Route::get("/products",[ProductController::class,"index"])->name("products.index");

Route::get("/products/create",[ProductController::class,"create"])->name("products.create");
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

Route::get("/products/edit/{id}",[ProductController::class,"edit"])->name("products.edit");
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

Route::get("/products/show/{id}",[ProductController::class,"show"])->name("products.show");

Route::delete("/products/delete/{id}",[ProductController::class,"destroy"])->name("products.destroy");
Route::post("/search",[ProductController::class,"search"])->name('products.search');

