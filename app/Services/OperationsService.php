<?php

namespace App\Services;

use App\Models\Operation;
use MacropaySolutions\LaravelCrudWizard\Services\BaseResourceService;

class OperationsService extends BaseResourceService
{
    /**
     * @inheritDoc
     */
    protected function setBaseModel(): void
    {
        $this->model = new Operation();
    }
}
