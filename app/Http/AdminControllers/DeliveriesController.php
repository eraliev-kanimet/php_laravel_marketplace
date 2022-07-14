<?php

namespace App\Http\AdminControllers;

use App\Http\Requests\Admin\DeliveryRequest;
use App\Models\Product\Delivery\Delivery;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class DeliveriesController extends AdminController
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(['data' => Delivery::all()]);
    }

    /**
     * @param DeliveryRequest $request
     * @return JsonResponse
     */
    public function store(DeliveryRequest $request): JsonResponse
    {
        $delivery = new Delivery($request->all());
        $delivery->save();

        return response()->json([], 201);
    }

    /**
     * @param DeliveryRequest $request
     * @param Delivery $delivery
     * @return JsonResponse
     */
    public function update(DeliveryRequest $request, Delivery $delivery): JsonResponse
    {
        $delivery->update($request->all());

        return response()->json([]);
    }

    /**
     * @param Delivery $delivery
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Delivery $delivery): JsonResponse
    {
        $this->authorize('delete', $delivery);

        $delivery->delete();

        return response()->json([], 204);
    }
}