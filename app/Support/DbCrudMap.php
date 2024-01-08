<?php

namespace App\Support;

use App\Http\Controllers\ClientsController;
use App\Http\Controllers\OperationsController;
use App\Http\Controllers\OperationsProductsPivotController;
use App\Http\Controllers\ProductsController;
use App\Models\Client;
use App\Models\Operation;
use App\Models\OperationProductPivot;
use App\Models\Product;

class DbCrudMap
{
    public const MODEL_FQN_TO_CONTROLLER_MAP = [
        Client::class => ClientsController::class,
        Operation::class => OperationsController::class,
        Product::class => ProductsController::class,
        OperationProductPivot::class => OperationsProductsPivotController::class
    ];
}
