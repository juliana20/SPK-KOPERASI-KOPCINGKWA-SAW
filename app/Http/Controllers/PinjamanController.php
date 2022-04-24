<?php

namespace App\Http\Controllers;

use App\Http\Model\Debitur_m;
use Illuminate\Http\Request;
use App\Http\Model\Pinjaman_m;
use App\Http\Model\Sub_kriteria_m;
use Validator;
use DataTables;
use Illuminate\Validation\Rule;
use DB;
use Response;

class PinjamanController extends Controller
{
    protected $model;
    protected $model_debitur;
    protected $model_sub_kriteria;
    public function __construct(Pinjaman_m $model, Debitur_m $model_debitur, Sub_kriteria_m $model_sub_kriteria)
    {
        $this->model = $model;
        $this->model_debitur = $model_debitur;
        $this->model_sub_kriteria = $model_sub_kriteria;
        $this->nameroutes = 'pinjaman';
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
            'title'             => 'Data Pinjaman',
            'breadcrumb'        => 'List Data Pinjaman',
            'headerModalTambah' => 'TAMBAH DATA PINJAMAN',
            'headerModalEdit'   => 'UBAH DATA PINJAMAN',
            'headerModalDetail' => 'DETAIL DATA PINJAMAN',
            'urlDatatables'     => 'pinjaman/datatables',
            'idDatatables'      => 'dt_pinjaman'
        );
        return view('pinjaman.datatable',$data);
    }

    public function create(Request $request)
    {
        $item = [
            'id_pinjaman'  => $this->model->gen_code('PNJ'),
            'tanggal_pinjaman' => date('Y-m-d'),
        ];
        $data = array(
            'item'                  => (object) $item,
            'submit_url'            => url()->current(),
            'is_edit'               => FALSE,
            'nameroutes'            => $this->nameroutes,
            'jaminan'               => $this->model_sub_kriteria::where('kode_kriteria', 'C3')->get(),
            'jumlah_pinjaman'               => $this->model_sub_kriteria::where('kode_kriteria', 'C1')->get(),
            'pekerjaan'               => $this->model_sub_kriteria::where('kode_kriteria', 'C6')->get(),
            'jenis_pinjaman'               => $this->model_sub_kriteria::where('kode_kriteria', 'C7')->get(),
            'pendapatan_perbulan'               => $this->model_sub_kriteria::where('kode_kriteria', 'C4')->get(),
            'riwayat_meminjam'               => $this->model_sub_kriteria::where('kode_kriteria', 'C5')->get(),
            'jangka_waktu'               => $this->model_sub_kriteria::where('kode_kriteria', 'C2')->get()
        );
        //jika form sumbit
        if($request->post())
        {
            $header = $request->input('f');
            $header['id_pinjaman'] = $this->model->gen_code('PNJ');
            
            $validator = Validator::make( $header, $this->model->rules['insert']);
            if ($validator->fails()) {
                $response = [
                    'message' => $validator->errors()->first(),
                    'status' => 'error',
                    'code' => 500,
                ];
                return Response::json($response);
            }

            DB::beginTransaction();
            try {
                $this->model->insert_data($header);
                DB::commit();
    
                $response = [
                    "message" => 'Data pinjaman berhasil disimpan',
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

        return view('pinjaman.form', $data);

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
            'jaminan'               => $this->model_sub_kriteria::where('kode_kriteria', 'C3')->get(),
            'jumlah_pinjaman'               => $this->model_sub_kriteria::where('kode_kriteria', 'C1')->get(),
            'pekerjaan'               => $this->model_sub_kriteria::where('kode_kriteria', 'C6')->get(),
            'jenis_pinjaman'               => $this->model_sub_kriteria::where('kode_kriteria', 'C7')->get(),
            'pendapatan_perbulan'               => $this->model_sub_kriteria::where('kode_kriteria', 'C4')->get(),
            'riwayat_meminjam'               => $this->model_sub_kriteria::where('kode_kriteria', 'C5')->get(),
            'jangka_waktu'               => $this->model_sub_kriteria::where('kode_kriteria', 'C2')->get()
        ];

        //jika form sumbit
        if($request->post())
        {
           //request dari view
           $header = $request->input('f');
           //validasi dari model
           $validator = Validator::make( $header, [
                'id_pinjaman' => [Rule::unique('tb_pinjaman')->ignore($get_data->id_pinjaman, 'id_pinjaman')],
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
                    "message" => 'Data pinjaman berhasil diperbarui',
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
        
        return view('pinjaman.form', $data);
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

        return view('pinjaman.view', $data);
    }

    public function datatables_collection()
    {
        $data = $this->model->get_all();
        return Datatables::of($data)->make(true);
    }

    public function datatables_lookup_alternatif()
    {
        $data = $this->model->get_all_lookup_alternatif();
        return Datatables::of($data)->make(true);
    }

}
