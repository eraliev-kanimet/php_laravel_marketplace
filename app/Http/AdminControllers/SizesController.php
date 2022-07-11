<?php

namespace App\Http\AdminControllers;

use App\Http\Requests\Admin\SizeCreateRequest;
use App\Http\Requests\Admin\SizeUpdateRequest;
use App\Models\Product\Size\Size;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class SizesController extends AdminController
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(['data' => Size::all()]);
    }

    /**
     * @param SizeCreateRequest $request
     * @return JsonResponse
     */
    public function store(SizeCreateRequest $request): JsonResponse
    {
        $size = new Size($request->all());
        $size->save();

        return response()->json([], 201);
    }

    /**
     * @param SizeUpdateRequest $request
     * @param Size $size
     * @return JsonResponse
     */
    public function update(SizeUpdateRequest $request, Size $size): JsonResponse
    {
        if ($request->get('name') != $size->name) {
            $request->validate(['name' => 'unique:sizes,name']);
        }

        $size->update($request->all());

        return response()->json([]);
    }

    /**
     * @param Size $size
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Size $size): JsonResponse
    {
        $this->authorize('delete', Size::class);
        $size->delete();

        return response()->json([], 204);
    }
}