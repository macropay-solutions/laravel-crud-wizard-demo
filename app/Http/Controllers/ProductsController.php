<?php

namespace App\Http\Controllers;


use App\Services\ProductsService;

class ProductsController extends ResourceController
{
    /**
     * @inheritDoc
     */
    protected function setResourceService(): void
    {
        $this->resourceService = \resolve(ProductsService::class);
    }
}
