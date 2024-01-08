<?php

namespace App\Services;

use App\Models\OperationProductPivot;
use MacropaySolutions\LaravelCrudWizard\Models\BaseModel;
use MacropaySolutions\LaravelCrudWizard\Services\BaseResourceService;

class OperationsProductsPivotService extends BaseResourceService
{
    /**
     * @inheritDoc
     */
    protected function setBaseModel(): void
    {
        $this->model = new OperationProductPivot();
    }

    /**
     * @inheritDoc
     */
    public function delete(string $identifier): bool
    {
        return (bool)$this->get($identifier, appendIndex: false)->deleteOrFail();
    }

    /**
     * @inheritDoc
     */
    public function update(string $identifier, array $request): BaseModel
    {
        throw new \Exception('Forbidden');
    }

    /**
     * @inheritDoc
     */
    protected function extractIdentifierConditions(string $identifier): array
    {
        $exploded = \explode('_', $identifier);

        return [
            ['operation_id', \reset($exploded)],
            ['product_id', \next($exploded)],
        ];
    }
}
