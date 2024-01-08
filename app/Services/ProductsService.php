<?php

namespace App\Services;

use App\Models\Product;
use MacropaySolutions\LaravelCrudWizard\Services\BaseResourceService;

class ProductsService extends BaseResourceService
{
    /**
     * @inheritDoc
     */
    protected function setBaseModel(): void
    {
        $this->model = new Product();
    }
}
