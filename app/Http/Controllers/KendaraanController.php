<?php

namespace App\Http\Controllers;

use App\Services\KendaraanService;
use Exception;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    protected $kendaraanService;

    public function __construct(KendaraanService $kendaraanService)
    {
        $this->kendaraanService = $kendaraanService;
    }

    public function index()
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->kendaraanService->getAll();
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function store(Request $request)
    {
        $data = $request->only([
            'jenis',
            'merk',
            'mesin',
            'kapasitas',
            'suspensi',
            'transmisi',
            'tahun',
            'warna',
            'harga',
            'stok'
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->kendaraanService->saveKendaraanData($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function show($id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->kendaraanService->getById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }

    public function update(Request $request, $id)
    {
        $data = $request->only([
            'jenis',
            'merk',
            'mesin',
            'kapasitas',
            'suspensi',
            'transmisi',
            'tahun',
            'warna',
            'harga',
            'stok'
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->kendaraanService->updateKendaraan($data, $id);

        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);

    }

    public function destroy($id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->kendaraanService->deleteById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }
}
