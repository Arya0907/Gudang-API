<?php

namespace App\Http\Controllers;

use App\Http\Resources\PackageResource;
use App\Services\PackageService;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    private $packageService;

    public function __construct(PackageService $packageService)
    {
        $this->packageService = $packageService;
    }

    public function index()
    {
        try {
          $packages = $this->packageService->index();
          return response()->json( PackageResource::collection($packages), 200);
        } catch (\Exception $err) {
            return response()->json(['error' => $err->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
          $package = $this->packageService->show($id);
          return response()->json( new PackageResource($package), 200);
        } catch (\Exception $err) {
            return response()->json(['error' => $err->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
          $package = $this->packageService->store($request->all());
          return response()->json( new PackageResource($package), 200);
        } catch (\Exception $err) {
            return response()->json(['error' => $err->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
          $package = $this->packageService->update($id, $request->all());
          return response()->json( new PackageResource($package), 200);
        } catch (\Exception $err) {
            return response()->json(['error' => $err->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
          $package = $this->packageService->destroy($id);
          return response()->json( new PackageResource($package), 200);
        } catch (\Exception $err) {
            return response()->json(['error' => $err->getMessage()], 500);
        }
    }

    public function restore($id)
    {
        try {
          $package = $this->packageService->restore($id);
          return response()->json( new PackageResource($package), 200);
        } catch (\Exception $err) {
            return response()->json(['error' => $err->getMessage()], 500);
        }
    }
}
