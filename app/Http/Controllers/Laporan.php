<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use GuzzleHttp\Psr7\Response as Psr7Response;
use PDF;
use Helpers;
use Response;

class Laporan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function pinjaman()
   {
            $item = [
                'date_start' => Carbon::now()->startOfMonth()->toDateString(),
                'date_end'   => Carbon::now()->endOfMonth()->toDateString()
            ];

            $data = array(
                'item'              => (object) $item,
                'title'             => 'Laporan Pinjaman',
                'url_print'         => 'laporan/pinjaman/print'
            );

            return view('laporan.form.pinjaman', $data);

    }

    public function print_pinjaman(Request $request)
    {
        $params = $request->input('f');
        $query = DB::table('tb_pinjaman as a')
                ->join('tb_alternatif as xx','a.id_alternatif','=','xx.id')
                ->join('tb_debitur as b','xx.id_debitur','=','b.id')
                ->join('tb_sub_kriteria as c','a.jaminan','=','c.id')
                ->join('tb_sub_kriteria as d','a.jumlah_pinjaman','=','d.id')
                ->join('tb_sub_kriteria as e','a.pekerjaan','=','e.id')
                ->join('tb_sub_kriteria as f','a.jenis_pinjaman','=','f.id')
                ->join('tb_sub_kriteria as g','a.pendapatan_perbulan','=','g.id')
                ->join('tb_sub_kriteria as h','a.riwayat_meminjam','=','h.id')
                ->join('tb_sub_kriteria as i','a.jangka_waktu','=','i.id')
                ->whereBetween('a.tanggal_pinjaman',[$params['date_start'],$params['date_end']])
                ->select(
                    'xx.kode_alternatif',
                    'a.id',
                    'a.id_pinjaman',
                    'a.tanggal_pinjaman',
                    'b.nama_debitur',
                    'b.alamat_debitur',
                    'b.telepon',
                    'c.nama_sub_kriteria as jaminan',
                    'd.nama_sub_kriteria as jumlah_pinjaman',
                    'e.nama_sub_kriteria as pekerjaan',
                    'f.nama_sub_kriteria as jenis_pinjaman',
                    'g.nama_sub_kriteria as pendapatan_perbulan',
                    'h.nama_sub_kriteria as riwayat_meminjam',
                    'i.nama_sub_kriteria as jangka_waktu'
                )->get();
        
        $data = [
            'params'       => (object) $params,
            'item'         => $query,
            'title'        => 'LAPORAN PINJAMAN',
        ];

        $pdf = PDF::loadView('laporan.print.cetak_pinjaman', $data, $params)->setPaper('a4', 'landscape');
        return $pdf->stream($params['date_start'].$params['date_end'].'laporan_pinjaman.pdf'); 
    }

    public function hasil_perhitungan()
    {
             $item = [
                 'date_start' => Carbon::now()->startOfMonth()->toDateString(),
                 'date_end'   => Carbon::now()->endOfMonth()->toDateString()
             ];
 
             $data = array(
                 'item'              => (object) $item,
                 'title'             => 'Laporan Hasil Perhitungan SPK',
                 'url_print'         => 'laporan/hasil-perhitungam/print'
             );
 
             return view('laporan.form.hasil_perhitungan', $data);
 
     }
 
     public function print_hasil_perhitungan(Request $request)
     {
         $query = DB::table('tb_hasil as a')
                    ->join('tb_pinjaman as b','a.id_pinjaman','=','b.id_pinjaman')
                    ->join('tb_alternatif as c','b.id_alternatif','=','c.id')
                    ->join('tb_debitur as d','c.id_debitur','=','d.id')
                    ->select(
                        'a.*',
                        'b.tanggal_pinjaman',
                        'd.nama_debitur'
                    )
                    ->orderBy('a.hasil_akhir', 'desc')
                    ->get();
                
         $data = [
             'item'         => $query,
             'title'        => 'LAPORAN HASIL PERHITUNGAN SPK',
         ];
 
         $pdf = PDF::loadView('laporan.print.cetak_hasil_perhitungan', $data)->setPaper('a4', 'landscape');
         return $pdf->stream('laporan_hasil_perhitungan.pdf'); 
     }
  
}