<?php 
namespace App\Repositories;
use App\Models\Package;
class PackageRepository
{
    public function getAllPackages()
    {
        return Package::all();
    }

    public function getPackageById($id)
    {
        return Package::find($id);
    }

    public function createPackage($data)
    {
        return Package::create($data);
    }

    public function updatePackage($id, $data)
    {
        Package::where('id', $id)->update($data);
        return Package::find($id);
    }

    public function updateStatus($id, string $status)
    {
        $package = Package::findOrFail($id);

        // Konversi status dari delivery ke status yang valid di packages
        $packageStatus = match ($status) {
            'on the way' => 'on delivery',
            'delivered' => 'delivered',
            'failed' => 'pending', // Jika gagal, bisa kembali ke pending atau status lain yang sesuai
            default => $package->status, // Jika status tidak dikenali, tetap gunakan yang lama
        };

        $package->update(['status' => $packageStatus]);
        return $package;
    }




    public function deletePackage($id)
    {
        $package = Package::findOrFail($id); // Ambil paket berdasarkan ID
        $package->delete();
        return $package;
    }

    public function restorePackage($id)
    {
        $package = Package::withTrashed()->findOrFail($id);
        $package->restore();
        return $package;
    }
}