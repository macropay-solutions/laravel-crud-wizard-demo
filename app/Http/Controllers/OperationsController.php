<?php

namespace App\Http\Controllers;


use App\Services\OperationsService;

class OperationsController extends ResourceController
{
    /**
     * @inheritDoc
     */
    protected function setResourceService(): void
    {
        $this->resourceService = \resolve(OperationsService::class);
    }
}
