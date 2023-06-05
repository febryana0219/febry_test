<?php

namespace App\Repositories;

use App\Models\Penjualan;
use App\Models\Kendaraan;

class PenjualanRepository
{
    protected $penjualann;

    public function __construct(Penjualan $penjualann)
    {
        $this->penjualann = $penjualann;
    }

    public function getAll()
    {
        return $this->penjualann->get();
    }

    public function getById($id)
    {
        return $this->penjualann->where('kendaraan_id', $id)->get();
    }

    public function save($data)
    {
        $penjualann = new $this->penjualann;

        $penjualann->kendaraan_id = $data['kendaraan_id'];
        $penjualann->jumlah = $data['jumlah'];
        $penjualann->tanggal_jual = $data['tanggal_jual'];

        $penjualann->save();

        $kendaraan = Kendaraan::find($data['kendaraan_id']);
        $kendaraan->stok = $kendaraan->stok - $data['jumlah'];

        $kendaraan->update();

        return $penjualann->fresh();
    }
}
