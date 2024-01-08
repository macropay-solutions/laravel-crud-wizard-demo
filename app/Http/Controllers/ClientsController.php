<?php

namespace App\Http\Controllers;


use App\Services\ClientsService;

class ClientsController extends ResourceController
{
    /**
     * @inheritDoc
     */
    protected function setResourceService(): void
    {
        $this->resourceService = \resolve(ClientsService::class);
    }
}
