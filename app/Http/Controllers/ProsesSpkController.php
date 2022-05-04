<?php

namespace App\Http\Controllers;

use App\Http\Model\Alternatif_m;
use App\Http\Model\Debitur_m;
use App\Http\Model\Hasil_akhir_m;
use App\Http\Model\Hasil_normalisasi_m;
use Illuminate\Http\Request;
use App\Http\Model\Pinjaman_m;
use App\Http\Model\Proses_spk_m;
use Validator;
use DataTables;
use Illuminate\Validation\Rule;
use DB;
use Response;

class ProsesSpkController extends Controller
{
    protected $model;
    protected $model_pinjaman;
    protected $model_hasil_normalisasi;
    protected $model_hasil;
    public function __construct(
            Proses_spk_m $model, 
            Pinjaman_m $model_pinjaman, 
            Hasil_normalisasi_m $model_hasil_normalisasi,
            Hasil_akhir_m $model_hasil
        )
    {
        $this->model = $model;
        $this->model_pinjaman = $model_pinjaman;
        $this->model_hasil_normalisasi = $model_hasil_normalisasi;
        $this->model_hasil = $model_hasil;
        $this->nameroutes = 'proses-spk';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
   {
        $data = array(
            'nameroutes'        => $this->nameroutes,
            'title'             => 'Proses SPK',
            'breadcrumb'        => 'Proses SPK',
            'urlDatatables'     => 'proses-spk/datatables',
            'idDatatables'      => 'dt_proses_spk'
        );
        return view('proses_spk.datatable',$data);
    }

    public function proses_normalisasi(Request $request)
    {
        #jika form sumbit
        if($request->post())
        {
            $detail = $request->post('details');
            if(empty($detail))
            {
                $response = [
                    'message'   => 'Tidak terdapat data pengajuan!',
                    'status'    => 'error',
                    'code'      => 500,
                ];
                return Response::json($response);
            }

            foreach($detail as $det){
                $C1[] = $det['C1'];
                $C2[] = $det['C2'];
                $C3[] = $det['C3'];
                $C4[] = $det['C4'];
                $C5[] = $det['C5'];
                $C6[] = $det['C6'];
                $C7[] = $det['C7'];
            }
            $C1_max = max( $C1);
            $C2_max = max( $C2);
            $C3_max = max( $C3);
            $C4_max = max( $C4);
            $C5_max = max( $C5);
            $C6_max = max( $C6);
            $C7_max = max( $C7);

            $data_perhitungan = [];
            foreach($detail as $row){
                $data_perhitungan[] = [
                    'id_pinjaman' => $row['id_pinjaman'],
                    'alternatif' => $row['kode_alternatif'],
                    'c1' => round($row['C1'] / $C1_max, 2),
                    'c2' => round($row['C2'] / $C2_max, 2),
                    'c3' => round($row['C3'] / $C3_max, 2),
                    'c4' => round($row['C4'] / $C4_max, 2),
                    'c5' => round($row['C5'] / $C5_max, 2),
                    'c6' => round($row['C6'] / $C6_max, 2),
                    'c7' => round($row['C7'] / $C7_max, 2),
                ];
            }

            Hasil_normalisasi_m::query()->delete();
            $this->model_hasil_normalisasi->insert_data($data_perhitungan);
            $response = [
                'message'   => 'Proses normalisasi berhasil!',
                'status'    => 'success',
                'code'      => 200,
            ];
            return Response::json($response);
        }

    }

    public function normalisasi()
    {
        $data = array(
            'nameroutes'        => $this->nameroutes,
            'title'             => 'Hasil Normalisasi',
            'breadcrumb'        => 'Hasil Normalisasi'
        );

        return view('proses_spk.normalisasi', $data);
    }

    public function proses_perhitungan_akhir(Request $request)
    {
        #jika form sumbit
        if($request->post())
        {
            $detail = $request->post('details');
            if(empty($detail))
            {
                $response = [
                    'message'   => 'Tidak terdapat data pengajuan!',
                    'status'    => 'error',
                    'code'      => 500,
                ];
                return Response::json($response);
            }

            foreach($detail as $det){
                $hasil_saw[] = [
                    'id_pinjaman' => $det['id_pinjaman'],
                    'alternatif' => $det['alternatif'],
                    'c1' => bobot_kriteria('c1') * round($det['c1'], 2) ,
                    'c2' => bobot_kriteria('c2') * round($det['c2'], 2),
                    'c3' => bobot_kriteria('c3') * round($det['c3'], 2),
                    'c4' => bobot_kriteria('c4') * round($det['c4'], 2),
                    'c5' => bobot_kriteria('c5') * round($det['c5'], 2),
                    'c6' => bobot_kriteria('c6') * round($det['c6'], 2),
                    'c7' => bobot_kriteria('c7') * round($det['c7'], 2),
                ];
            }

            foreach($hasil_saw as $key){
                Pinjaman_m::where('id_pinjaman', $key['id_pinjaman'])->update(['sudah_proses' => 1]);
                Hasil_normalisasi_m::query()->delete();
                $hitung_hasil = round($key['c1'] + $key['c2'] + $key['c3'] + $key['c4'] + $key['c5'] + $key['c6'] + $key['c7'], 2);

                if(($hitung_hasil >= 0) && ($hitung_hasil <= 0.25)){
                    $keputusan = 'Tidak direkomendasikan';
                }else if(($hitung_hasil >= 0.26) && ($hitung_hasil <= 0.50)){
                    $keputusan = 'Dipertimbangkan';
                }else if(($hitung_hasil >= 0.51) && ($hitung_hasil <= 0.75)){
                    $keputusan = 'Direkomendasikan';
                }else if(($hitung_hasil >= 0.76) && ($hitung_hasil <= 1)){
                    $keputusan = 'Sangat Direkomendasikan';
                }
                $hasil_akhir[] = [
                    'id_pinjaman' => $key['id_pinjaman'],
                    'alternatif' => $key['alternatif'],
                    'c1' => round($key['c1'],2),
                    'c2' => round($key['c2'],2),
                    'c3' => round($key['c3'],2),
                    'c4' => round($key['c4'],2),
                    'c5' => round($key['c5'],2),
                    'c6' => round($key['c6'],2),
                    'c7' => round($key['c7'],2),
                    'hasil_akhir' => $hitung_hasil,
                    'keputusan' => $keputusan,
                    'created_at' => date('Y-m-d H:i:s')
                ];
            }

            $this->model_hasil->insert_data($hasil_akhir);
            
            $response = [
                'message'   => 'Proses perhitungan akhir berhasil!',
                'status'    => 'success',
                'code'      => 200,
            ];
            return Response::json($response);

        }
    }

    public function perhitungan_akhir()
    {
        $data = array(
            'nameroutes'        => $this->nameroutes,
            'title'             => 'Hasil Perhitungan Akhir',
            'breadcrumb'        => 'Hasil Perhitungan Akhir'
        );

        return view('proses_spk.perhitungan_akhir', $data);
    }

    public function perangkingan()
    {
        $data = array(
            'nameroutes'        => $this->nameroutes,
            'title'             => 'Data Perangkingan',
            'breadcrumb'        => 'Perangkingan'
        );

        return view('proses_spk.perangkingan', $data);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $get_data = $this->model->get_one($id);
        $data = [
            'item'                      => $get_data,
            'is_edit'                   => TRUE,
            'submit_url'                => url()->current(),
            'nameroutes'                => $this->nameroutes,
            'pinjaman'                  => $this->model_pinjaman::get(),
        ];

        //jika form sumbit
        if($request->post())
        {
           //request dari view
           $header = $request->input('f');
           //validasi dari model
           $validator = Validator::make( $header, [
                'id_pinjaman' => [Rule::unique('tb_alternatif')->ignore($get_data->pinjaman_id, 'id_pinjaman')],
                'kode_alternatif' => [Rule::unique('tb_alternatif')->ignore($get_data->kode_alternatif, 'kode_alternatif')],
            ]);
           if ($validator->fails()) {
               $response = [
                   'message' => $validator->errors()->first(),
                   'status' => 'error',
                   'code' => 500,
               ];
               return Response::json($response);
           }

            //insert data
            DB::beginTransaction();
            try {
                $this->model->update_data($header, $id);
                DB::commit();

                $response = [
                    "message" => 'Data alternatif berhasil diperbarui',
                    'status' => 'success',
                    'code' => 200,
                ];
           
            } catch (\Exception $e) {
                DB::rollback();
                $response = [
                    "message" => $e->getMessage(),
                    'status' => 'error',
                    'code' => 500,
                    
                ];
            }
            return Response::json($response); 
        }
        
        return view('alternatif.form', $data);
    }

    public function view($id)
    {
        $get_data = $this->model->get_one($id);
        $data = [
            'item'                      => $get_data,
            'is_edit'                   => TRUE,
            'submit_url'                => url()->current(),
            'nameroutes'                => $this->nameroutes,
        ];

        return view('alternatif.view', $data);
    }

    public function reset_hasil()
    {
        Hasil_normalisasi_m::query()->delete();
        Hasil_akhir_m::query()->delete();
        Pinjaman_m::query()->update(['sudah_proses' => 0]);
        
        $response = [
            'message'   => 'Berhasil melakukan reset hasil perhitungan!',
            'status'    => 'success',
            'code'      => 200,
        ];
        return Response::json($response);

    }

    public function datatables_collection()
    {
        $data = $this->model->get_all();
        return Datatables::of($data)->make(true);
    }
    public function datatables_collection_normalisasi()
    {
        $data = $this->model_hasil_normalisasi->get_all();
        return Datatables::of($data)->make(true);
    }
    public function datatables_collection_perhitungan_akhir()
    {
        $data = $this->model_hasil->get_all();
        return Datatables::of($data)->make(true);
    }

}
