<?php 
namespace App\Services;
use App\Repositories\PackageRepository;
class PackageService 
{
    private $packageRepository;

    public function __construct(PackageRepository $packageRepository)
    {
        $this->packageRepository = $packageRepository;
    }

    public function index()
    {
        return $this->packageRepository->getAllPackages();
    }

    public function show($id)
    {
        return $this->packageRepository->getPackageById($id);
    }

    public function store($data)
    {
        return $this->packageRepository->createPackage($data);
    }

    public function update($id, $data)
    {
        return $this->packageRepository->updatePackage($id, $data);
    }

    public function destroy($id)
    {
        return $this->packageRepository->deletePackage($id);
    }

    public function restore($id)
    {
        return $this->packageRepository->restorePackage($id);
    }
}