<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use MacropaySolutions\LaravelCrudWizard\Eloquent\CustomRelations\HasManyThrough2LinkTables;
use MacropaySolutions\LaravelCrudWizard\Models\BaseModel;

class Product extends BaseModel
{
    public const RESOURCE_NAME = 'products';
    public const WITH_RELATIONS = [
        'operations',
        'clients',
    ];
    public const SUMMABLE_COLUMNS = [
        'value',
    ];
    protected array $ignoreUpdateFor = [
        'ean',
        'code',
        'value',
        'currency',
    ];
    protected $table = 'products';
    protected $fillable = [
        'ean',
        'name',
        'code',
        'value',
        'currency',
        'created_at',
        'updated_at',
    ];

    public function clients(): HasManyThrough2LinkTables
    {
        return new HasManyThrough2LinkTables(
            $this->newRelatedInstance(Client::class)->newQuery(),
            $this,
            new OperationProductPivot(),
            'product_id',
            'id',
            'id',
            'operation_id',
            new Operation(),
            'id',
            'client_id',
        );
    }

    public function operations(): HasManyThrough
    {
        return $this->hasManyThrough(
            Operation::class,
            OperationProductPivot::class,
            'product_id',
            'id',
            'id',
            'operation_id'
        );
    }
}
