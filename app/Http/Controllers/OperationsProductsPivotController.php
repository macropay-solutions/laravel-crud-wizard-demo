<?php

namespace App\Http\Controllers;


use App\Services\OperationsProductsPivotService;

class OperationsProductsPivotController extends ResourceController
{
    /**
     * @inheritDoc
     */
    protected function setResourceService(): void
    {
        $this->resourceService = \resolve(OperationsProductsPivotService::class);
    }
}
