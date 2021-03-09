<?php

use Illuminate\Database\Seeder;
use App\Supplier;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $supplier1 = new Supplier;
        $supplier1 -> nama_supplier = "TOKO DIYAH AYU";
        $supplier1 -> alamat_supplier = "Korea Selatan";
        $supplier1 -> telp_supplier = "082244775098";
        $supplier1 -> save();

        $supplier2 = new Supplier;
        $supplier2 -> nama_supplier = "TOKO APRILINGGA";
        $supplier2 -> alamat_supplier = "Australia";
        $supplier2 -> telp_supplier = "082244775091";
        $supplier2 -> save();

    }
}
