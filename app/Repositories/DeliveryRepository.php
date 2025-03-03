<?php
namespace App\Repositories;

use App\Models\Delivery;

class DeliveryRepository
{
    public function getAll()
    {
        return Delivery::all();
    }

    public function findById($id)
    {
        return Delivery::findOrFail($id);
    }

    public function create(array $data)
    {
        return Delivery::create($data);
    }

    public function update($id, array $data)
    {
        $delivery = Delivery::findOrFail($id);
        $delivery->update($data);
        return $delivery;
    }

    public function delete($id)
    {
        return Delivery::destroy($id);
    }

    public function restore($id)
    {
        $delivery = Delivery::onlyTrashed()->findOrFail($id);
        $delivery->restore();
        return $delivery;
    }
}