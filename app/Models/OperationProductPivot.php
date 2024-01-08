<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use MacropaySolutions\LaravelCrudWizard\Models\BaseModel;

class OperationProductPivot extends BaseModel
{
    public const RESOURCE_NAME = 'operations-products-pivot';
    public const WITH_RELATIONS = [
        'client',
        'operation',
    ];
    public $incrementing = false;
    protected $table = 'operations_products_pivot';
    protected $primaryKey = '';
    protected $fillable = [
        'operation_id',
        'product_id',
        'created_at',
    ];

    public function operation(): HasOne
    {
        return $this->hasOne(Client::class, 'id', 'operation_id');
    }

    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function getPrimaryKeyFilter(): array
    {
        return [
            'operation_id' => $this->getAttribute('operation_id'),
            'product_id' => $this->getAttribute('product_id')
        ];
    }
}
