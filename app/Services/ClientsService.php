<?php

namespace App\Services;

use App\Models\Client;
use MacropaySolutions\LaravelCrudWizard\Services\BaseResourceService;

class ClientsService extends BaseResourceService
{
    /**
     * @inheritDoc
     */
    protected function setBaseModel(): void
    {
        $this->model = new Client();
    }
}
