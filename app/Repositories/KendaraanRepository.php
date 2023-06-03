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
        return $this->kendaraan->where('id', $id)->get();
    }

    public function save($data)
    {
        $kendaraan = new $this->kendaraan;

        $kendaraan->title = $data['title'];
        $kendaraan->description = $data['description'];

        $kendaraan->save();

        return $kendaraan->fresh();
    }

    public function update($data, $id)
    {
        $kendaraan = $this->kendaraan->find($id);

        $kendaraan->title = $data['title'];
        $kendaraan->description = $data['description'];

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
