<?php

namespace App\Http\Controllers;

use App\BarangModel;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barang = BarangModel::all();
        return response()->json($barang, 200);
    }

    public function simpanData(Request $request)
    {
        $barang = new BarangModel();
        $barang->nama = $request->nama;
        $barang->harga = $request->harga;
        $barang->stok = $request->stok;
        $barang->save();

        return response([
            'status' => 'Berhasil',
            'message' => 'Barang berhasil disimpan',
            'data' => $barang
        ], 200);
    }

    public function rubahData(Request $request, $id)
    {
        $cekBarang = BarangModel::firstWhere('id', $id);
        if ($cekBarang) {
            $barang = BarangModel::find($id);
            $barang->nama = $request->nama;
            $barang->harga = $request->harga;
            $barang->stok = $request->stok;
            $barang->save();
            return response([
                'status' => 'Berhasil',
                'message' => 'Barang berhasil dirubah',
                'data' => $barang
            ], 200);
        } else {
            return response([
                'status' => 'Not Found',
                'message' => 'Barang tidak ditemukan !!!'
            ], 404);
        }
    }

    public function hapusData($id)
    {
        $cekBarang = BarangModel::firstWhere('id', $id);
        if ($cekBarang) {
            BarangModel::destroy($id);
            return response([
                'status' => 'Berhasil',
                'message' => 'Barang berhasil dihapus'
            ], 200);
        } else {
            return response([
                'status' => 'Not Found',
                'message' => 'Barang tidak ditemukan !!!'
            ], 404);
        }
    }

    public function beli(Request $request, $id)
    {
        $cekBarang = BarangModel::firstWhere('id', $id);
        if ($cekBarang) {

            $barang = BarangModel::find($id);
            $updStok = $barang->stok + $request->purchase;
            $barang->update(['stok' => $updStok]);
            return response([
                'status' => 'Berhasil',
                'message' => 'Barhasil Purchase',
                'data' => $barang
            ], 200);
        } else {
            return response([
                'status' => 'Not Found',
                'message' => 'Barang tidak ditemukan !!!'
            ], 404);
        }
    }
}
