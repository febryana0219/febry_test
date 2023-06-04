<?php

namespace App\Services;

use App\Models\Kendaraan;
use App\Repositories\KendaraanRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class KendaraanService
{
    protected $kendaraanRepository;

    public function __construct(KendaraanRepository $kendaraanRepository)
    {
        $this->kendaraanRepository = $kendaraanRepository;
    }

    public function deleteById($id)
    {
        DB::beginTransaction();

        try {
            $kendaraan = $this->kendaraanRepository->delete($id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Tidak dapat menghapus data kendaraan');
        }

        DB::commit();

        return $kendaraan;

    }

    public function getAll()
    {
        return $this->kendaraanRepository->getAll();
    }

    public function getById($id)
    {
        return $this->kendaraanRepository->getById($id);
    }

    public function updateKendaraan($data, $id)
    {
        $validator = Validator::make($data, [
            'jenis' => 'required',
            'merk' => 'required',
            'mesin' => 'required',
            'kapasitas' => 'required',
            'suspensi' => 'required',
            'transmisi' => 'required',
            'tahun' => 'required',
            'warna' => 'required',
            'harga' => 'required'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->kendaraanRepository->update($data, $id);

        return $result;
    }

    public function saveKendaraanData($data)
    {
        $validator = Validator::make($data, [
            'jenis' => 'required',
            'merk' => 'required',
            'mesin' => 'required',
            'kapasitas' => 'required',
            'suspensi' => 'required',
            'transmisi' => 'required',
            'tahun' => 'required',
            'warna' => 'required',
            'harga' => 'required',
            'stok' => 'required'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->kendaraanRepository->save($data);

        return $result;
    }
}
