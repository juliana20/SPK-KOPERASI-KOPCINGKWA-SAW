<?php

namespace App\Http\Controllers;

use App\Http\Model\Alternatif_m;
use App\Http\Model\Debitur_m;
use Illuminate\Http\Request;
use Validator;
use DataTables;
use Illuminate\Validation\Rule;
use DB;
use Response;

class AlternatifController extends Controller
{
    protected $model;
    protected $model_debitur;
    public function __construct(Alternatif_m $model, Debitur_m $model_debitur)
    {
        $this->model = $model;
        $this->model_debitur = $model_debitur;
        $this->nameroutes = 'alternatif';
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
            'title'             => 'Data Alternatif',
            'breadcrumb'        => 'List Data Alternatif',
            'headerModalTambah' => 'TAMBAH DATA ALTERNATIF',
            'headerModalEdit'   => 'UBAH DATA ALTERNATIF',
            'headerModalDetail' => 'DETAIL DATA ALTERNATIF',
            'urlDatatables'     => 'alternatif/datatables',
            'idDatatables'      => 'dt_alternatif'
        );
        return view('alternatif.datatable',$data);
    }

    public function create(Request $request)
    {
        $item = [
            'kode_alternatif'  => $this->model->gen_code('A'),
            'id_debitur' => null,
        ];
        $data = array(
            'item'                  => (object) $item,
            'submit_url'            => url()->current(),
            'is_edit'               => FALSE,
            'nameroutes'            => $this->nameroutes,
            'debitur'               => $this->model_debitur::get(),
        );
        //jika form sumbit
        if($request->post())
        {
            $header = $request->input('f');
            
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
                    "message" => 'Data alternatif berhasil disimpan',
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
            'item'         => $get_data,
            'is_edit'      => TRUE,
            'submit_url'   => url()->current(),
            'nameroutes'   => $this->nameroutes,
            'debitur'      => $this->model_debitur::get()
        ];

        //jika form sumbit
        if($request->post())
        {
           //request dari view
           $header = $request->input('f');
           //validasi dari model
           $validator = Validator::make( $header, [
                'id_debitur' => [Rule::unique('tb_alternatif')->ignore($get_data->id_debitur, 'id_debitur')],
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

    public function datatables_collection()
    {
        $data = $this->model->get_all();
        return Datatables::of($data)->make(true);
    }

}
