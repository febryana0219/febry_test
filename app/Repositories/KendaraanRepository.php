<?php

namespace App\Repositories;

use App\Models\Kendaraan;

class KendaraanRepository
{
    protected $kendaraan;

    public function __construct(Kendaraan $kendaraan)
    {
        $this->kendaraan = $kendaraan;
    }

    public function getAll()
    {
        return $this->kendaraan->get();
    }

    public function getById($id)
    {
        return $this->kendaraan->where('_id', $id)->get();
    }

    public function save($data)
    {
        $kendaraan = new $this->kendaraan;

        $kendaraan->jenis = $data['jenis'];
        $kendaraan->merk = $data['merk'];
        $kendaraan->mesin = $data['mesin'];
        $kendaraan->kapasitas = $data['kapasitas'];
        $kendaraan->suspensi = $data['suspensi'];
        $kendaraan->transmisi = $data['transmisi'];
        $kendaraan->tahun = $data['tahun'];
        $kendaraan->warna = $data['warna'];
        $kendaraan->harga = $data['harga'];
        $kendaraan->stok = $data['stok'];

        $kendaraan->save();

        return $kendaraan->fresh();
    }

    public function update($data, $id)
    {
        $kendaraan = $this->kendaraan->find($id);
        $kendaraan->jenis = $data['jenis'];
        $kendaraan->merk = $data['merk'];
        $kendaraan->mesin = $data['mesin'];
        $kendaraan->kapasitas = $data['kapasitas'];
        $kendaraan->suspensi = $data['suspensi'];
        $kendaraan->transmisi = $data['transmisi'];
        $kendaraan->tahun = $data['tahun'];
        $kendaraan->warna = $data['warna'];
        $kendaraan->harga = $data['harga'];
        $kendaraan->stok = $data['stok'];

        $kendaraan->update();

        return $kendaraan;
    }

    public function delete($id)
    {
        $kendaraan = $this->kendaraan->find($id);
        $kendaraan->delete();

        return $kendaraan;
    }
}
