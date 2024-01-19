<?php

namespace App\Http\Controllers;

use App\Requests\ResourceRequest;
use App\Support\DbCrudMap;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use MacropaySolutions\LaravelCrudWizard\Exceptions\CrudValidationException;
use MacropaySolutions\LaravelCrudWizard\Helpers\GeneralHelper;
use MacropaySolutions\LaravelCrudWizard\Http\Controllers\ResourceControllerTrait;

class ResourceController extends Controller
{
    use ResourceControllerTrait;

    /**
     * @throws \Throwable
     */
    public function __construct()
    {
        $this->init(100);
    }

    public function create(Request $request): JsonResponse
    {
        try {
            $validated = $this->validateCreateRequest($request);

            return \response()->json($this->resourceService->create($validated)->toArray(), 201);
        } catch (ValidationException | CrudValidationException $e) {
            return \response()->json(['message' => $e->getMessage(), 'errors' => $e->errors()], 400);
        } catch (\Throwable $e) {
            Log::error($this->label . ' create error = ' . $e->getMessage());

            return \response()->json(['message' => GeneralHelper::getSafeErrorMessage($e)], 400);
        }
    }

    public function update(string $identifier, Request $request): JsonResponse
    {
        try {
            $validated = $this->validateUpdateRequest($request);

            try {
                return \response()->json($this->resourceService->update($identifier, $validated)->toArray());
            } catch (ModelNotFoundException $e) {
                if (!$this->resourceService->isUpdateOrCreateAble($request->all())) {
                    throw $e;
                }

                $request->server->set('REQUEST_METHOD', 'POST');

                return $this->create($request);
            }
        } catch (ValidationException | CrudValidationException $e) {
            return \response()->json(['message' => $e->getMessage(), 'errors' => $e->errors()], 400);
        } catch (\Throwable $e) {
            Log::error($this->label . ' update for identifier: ' . $identifier . ', error = ' . $e->getMessage());

            return \response()->json(['message' => GeneralHelper::getSafeErrorMessage($e)], 400);
        }
    }

    protected function setModelFqnToControllerMap(): void
    {
        $this->modelFqnToControllerMap = DbCrudMap::MODEL_FQN_TO_CONTROLLER_MAP;
    }

    /**
     * @throws \Throwable
     */
    protected function validateCreateRequest(Request $request): array
    {
        return \resolve(ResourceRequest::class)->validated();
    }

    /**
     * @throws \Throwable
     */
    protected function validateUpdateRequest(Request $request): array
    {
        return $this->validateCreateRequest($request);
    }
}
