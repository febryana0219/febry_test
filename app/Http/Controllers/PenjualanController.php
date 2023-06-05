<?php

namespace App\Http\Controllers;

use App\Services\PenjualanService;
use Exception;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    protected $penjualanService;

    public function __construct(PenjualanService $penjualanService)
    {
        $this->penjualanService = $penjualanService;
    }

    public function index()
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->penjualanService->getAll();
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
            'kendaraan_id',
            'jumlah',
            'tanggal_jual'
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->penjualanService->savePenjualanData($data);
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
            $result['data'] = $this->penjualanService->getById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }
}
