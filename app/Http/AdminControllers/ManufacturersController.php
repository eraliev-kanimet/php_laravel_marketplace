<?php

namespace App\Http\AdminControllers;

use App\Http\Requests\Admin\ManufacturerCreateRequest;
use App\Http\Requests\Admin\ManufacturerUpdateRequest;
use App\Models\Manufacturer\Manufacturer;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class ManufacturersController extends AdminController
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(['data' => Manufacturer::all()]);
    }

    /**
     * @param ManufacturerCreateRequest $request
     * @return JsonResponse
     */
    public function store(ManufacturerCreateRequest $request): JsonResponse
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $this->saveImage($request->file('image'));
        }

        $manufacturer = new Manufacturer($data);
        $manufacturer->save();

        return response()->json([], 201);
    }

    /**
     * @param ManufacturerUpdateRequest $request
     * @param Manufacturer $manufacturer
     * @return JsonResponse
     */
    public function update(ManufacturerUpdateRequest $request, Manufacturer $manufacturer): JsonResponse
    {
        $data = $request->all();

        if ($request->get('name') != $manufacturer->name) {
            $request->validate([
                'name' => 'unique:manufacturers,name'
            ]);
        }

        if ($request->has('remove_image')) {
            $data['image'] = '';
            unset($data['remove_image']);
        }

        if ($request->hasFile('image')) {
            $data['image'] = $this->saveImage($request->file('image'));
        }

        $manufacturer->update($data);

        return response()->json([]);
    }

    /**
     * @param Manufacturer $manufacturer
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Manufacturer $manufacturer): JsonResponse
    {
        $this->authorize('delete', $manufacturer);

        $manufacturer->delete();

        return response()->json([], 204);
    }
}