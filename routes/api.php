<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$callback = function (\Illuminate\Routing\Router $router): void {
    try {
        foreach (
            \MacropaySolutions\LaravelCrudWizard\Helpers\ResourceHelper::getResourceNameToControllerFQNMap(
                \App\Support\DbCrudMap::MODEL_FQN_TO_CONTROLLER_MAP
            ) as $resource => $controller
        ) {
            Route::get('/' . $resource, [$controller, 'list'])->name('apiinfo.list_' . $resource);
            Route::post('/' . $resource, [$controller, 'create'])->name('apiinfo.create_' . $resource);
            Route::put('/' . $resource . '/{identifier}', [$controller, 'update'])->name('apiinfo.update_' . $resource);
            Route::get('/' . $resource . '/{identifier}', [$controller, 'get'])->name('apiinfo.get_' . $resource);
            Route::delete('/' . $resource . '/{identifier}', [$controller, 'delete'])->name(
                'apiinfo.delete_' . $resource
            );
            Route::get('/' . $resource . '/{identifier}/{relation}', [$controller, 'listRelation']);
        }
    } catch (Throwable $e) {
        \Illuminate\Support\Facades\Log::error($e->getMessage());
    }
};

Route::domain(\trim(\env('APP_URL')))
    ->middleware('auth:sanctum')
    ->group($callback);
