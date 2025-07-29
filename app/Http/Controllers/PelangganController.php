<?php
namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function cari(Request $request)
    {
        $request->validate([
            'keyword' => 'required|string',
        ]);

        $pelanggan = Pelanggan::where('id_pelanggan', $request->keyword)
            ->orWhere('no_kwh', $request->keyword)
            ->first();

        if ($pelanggan) {
            return response()->json([
                'success' => true,
                'data'    => [
                    'id_pelanggan'    => $pelanggan->nomor_kwh,
                    'nama'            => $pelanggan->nama_pelanggan,
                    'alamat'          => $pelanggan->alamat,
                    'tarif_daya'      => $pelanggan->tarif_daya,
                    'lembar_tagihan'  => 1,
                    'periode'         => 'MAR25', // atau ambil dari tagihan terakhir
                    'tagihan_listrik' => 'Rp500.000',
                    'biaya_admin'     => 'Rp2.500',
                    'ppn'             => 'Rp5.000',
                    'total_bayar'     => 'Rp507.500',
                ],
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'ID Pelanggan atau Nomor kWh tidak ditemukan!',
            ]);
        }
    }
}
