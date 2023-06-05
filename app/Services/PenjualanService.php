<?php

namespace App\Services;

use App\Models\Penjualan;
use App\Repositories\PenjualanRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class PenjualanService
{
    protected $penjualannRepository;

    public function __construct(PenjualanRepository $penjualannRepository)
    {
        $this->penjualannRepository = $penjualannRepository;
    }

    public function getAll()
    {
        return $this->penjualannRepository->getAll();
    }

    public function getById($id)
    {
        return $this->penjualannRepository->getById($id);
    }

    public function savePenjualanData($data)
    {
        $validator = Validator::make($data, [
            'kendaraan_id' => 'required',
            'jumlah' => 'required',
            'tanggal_jual' => 'required'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->penjualannRepository->save($data);

        return $result;
    }
}
