<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return '<html><body><pre><h1>TEST DB FOR laravel-lumen-crud-wizard (displays max 10 rows from every resource)</h1>' .
        '<h1>clients</h1><h3>relations:' .
        \implode(
            ',',
            \App\Models\Client::WITH_RELATIONS) . '</h3>' .
        \json_encode(
            \App\Models\Client::query()->limit(10)->get()->toArray(),
            JSON_PRETTY_PRINT
        ) . '<h1>operations</h1><h3>relations:' .
        \implode(
            ',',
            \App\Models\Operation::WITH_RELATIONS) . '</h3>' .
        \json_encode(
            \App\Models\Operation::query()->limit(10)->get()->toArray(),
            JSON_PRETTY_PRINT
        ) . '<h1>operations-products-pivot</h1><h3>relations:' .
        \implode(
            ',',
            \App\Models\OperationProductPivot::WITH_RELATIONS) . '</h3>' .
        \json_encode(
            \App\Models\OperationProductPivot::query()->limit(10)->get()->toArray(),
            JSON_PRETTY_PRINT
        ) . '<h1>products</h1><h3>relations:' .
        \implode(
            ',',
            \App\Models\Product::WITH_RELATIONS) . '</h3>' .
        \json_encode(
            \App\Models\Product::query()->limit(10)->get()->toArray(),
            JSON_PRETTY_PRINT
        ) . '</pre></body></html>';
});
Route::get(
    '/login',
    fn (): \Illuminate\Http\JsonResponse => \response()->json(['message' => 'Unauthorized'], 401)
)->name('login');
