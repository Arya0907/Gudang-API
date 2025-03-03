<?php

namespace App\Http\Controllers;
use App\Http\Requests\UpdateDeliveryRequest;
use App\Services\DeliveryService;
use App\Http\Requests\DeliveryRequest;
use App\Http\Resources\DeliveryResource;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    protected $deliveryService;

    public function __construct(DeliveryService $deliveryService)
    {
        $this->deliveryService = $deliveryService;
    }

    public function index()
    {
        return response()->json($this->deliveryService->index());
    }

    public function show($id)
    {
        return response()->json($this->deliveryService->show($id));
    }

    public function store(Request $request)
    {
       try {
        $payload = DeliveryRequest::validate($request);
        $delivery = $this->deliveryService->store($payload);
        return response()->json( new DeliveryResource($delivery), 201);
       } catch (\Exception $err) {
        return response()->json(['error' => $err->getMessage()], 400);
       }

      
    }

    public function update(Request $request, $id)
    {
        $data = UpdateDeliveryRequest::validate($request);

        return response()->json($this->deliveryService->update($id, $data));
    }

    public function destroy($id)
    {
        return response()->json($this->deliveryService->destroy($id));
    }

    public function restore($id)
    {
        return response()->json($this->deliveryService->restore($id));
    }
}
