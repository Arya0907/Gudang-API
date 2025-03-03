<?php 

namespace App\Services;

use App\Repositories\DeliveryRepository;
use App\Repositories\PackageRepository;

class DeliveryService 
{
    private $deliveryRepository;
    private $packageRepository;

    public function __construct(DeliveryRepository $deliveryRepository, PackageRepository $packageRepository)
    {
        $this->deliveryRepository = $deliveryRepository;
        $this->packageRepository = $packageRepository;
    }

    public function index()
    {
        return $this->deliveryRepository->getAll();
    }

    public function show($id)
    {
        return $this->deliveryRepository->findById($id);
    }

    public function store($data)
    {
        return $this->deliveryRepository->create($data);
    }

    public function update($id, $data)
    {
        $delivery = $this->deliveryRepository->findById($id);

        // Update delivery
        $updatedDelivery = $this->deliveryRepository->update($id, $data);

        // Jika status diubah, update juga status package terkait
        if (isset($data['status'])) {
            $packageId = $delivery->package_id;
            $this->packageRepository->updateStatus($packageId, (string) $data['status']); // ✅ Pastikan sebagai string
        }

        return $updatedDelivery;
    }



    public function destroy($id)
    {
        return $this->deliveryRepository->delete($id);
    }

    public function restore($id)
    {
        return $this->deliveryRepository->restore($id);
    }

}