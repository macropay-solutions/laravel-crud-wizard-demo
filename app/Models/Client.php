<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use MacropaySolutions\LaravelCrudWizard\Eloquent\CustomRelations\HasManyThrough2LinkTables;
use MacropaySolutions\LaravelCrudWizard\Models\BaseModel;

class Client extends BaseModel
{
    public const RESOURCE_NAME = 'clients';
    public const WITH_RELATIONS = [
        'operations',
        'products',
    ];
    protected $table = 'clients';
    protected array $ignoreUpdateFor = [
        'created_at'
    ];
    protected $fillable = [
        'name',
        'active',
        'created_at',
        'updated_at',
    ];

    public function operations(): HasMany
    {
        return $this->hasMany(Operation::class, 'client_id', 'id');
    }

    public function products(): HasManyThrough2LinkTables
    {
        return new HasManyThrough2LinkTables(
            $this->newRelatedInstance(Product::class)->newQuery(),
            $this,
            new Operation(),
            'client_id',
            'id',
            'id',
            'id',
            new OperationProductPivot(),
            'operation_id',
            'product_id',
        );
    }
}
