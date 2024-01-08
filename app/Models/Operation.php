<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use MacropaySolutions\LaravelCrudWizard\Models\BaseModel;

class Operation extends BaseModel
{
    public const RESOURCE_NAME = 'operations';
    public const WITH_RELATIONS = [
        'parent',
        'children',
        'client',
        'products'
    ];
    public const SUMMABLE_COLUMNS = [
        'value',
    ];
    protected array $ignoreUpdateFor = [
        'client_id',
        'currency',
        'value',
        'created_at',
    ];
    protected $table = 'operations';
    protected $fillable = [
        'parent_id',
        'client_id',
        'currency',
        'value',
        'created_at',
        'updated_at',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function products(): HasManyThrough
    {
        return $this->hasManyThrough(
            Product::class,
            OperationProductPivot::class,
            'operation_id',
            'id',
            'id',
            'product_id'
        );
    }
}
