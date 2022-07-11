<?php

namespace App\Http\AdminControllers;

use App\Http\Requests\Admin\ColorCreateRequest;
use App\Http\Requests\Admin\ColorUpdateRequest;
use App\Models\Product\Color\Color;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class ColorsController extends AdminController
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(['data' => Color::all()]);
    }

    /**
     * @param ColorCreateRequest $request
     * @return JsonResponse
     */
    public function store(ColorCreateRequest $request): JsonResponse
    {
        $color = new Color($request->all());
        $color->save();

        return response()->json([], 201);
    }

    /**
     * @param ColorUpdateRequest $request
     * @param Color $color
     * @return JsonResponse
     */
    public function update(ColorUpdateRequest $request, Color $color): JsonResponse
    {
        if ($request->get('name') != $color->name) {
            $request->validate(['name' => 'unique:colors,name']);
        }

        if ($request->get('color') != $color->color) {
            $request->validate(['color' => 'unique:colors,color']);
        }

        $color->update($request->all());

        return response()->json([]);
    }

    /**
     * @param Color $color
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Color $color): JsonResponse
    {
        $this->authorize('delete', $color);
        $color->delete();

        return response()->json([], 204);
    }
}