<?php

namespace App\Http\Controllers;

use App\Http\Model\Kriteria_m;
use Illuminate\Http\Request;
use App\Http\Model\Sub_kriteria_m;
use Validator;
use DataTables;
use Illuminate\Validation\Rule;
use Helpers;
use DB;
use Response;

class SubKriteriaController extends Controller
{
    protected $model;
    public function __construct(Sub_kriteria_m $model, Kriteria_m $model_kriteria)
    {
        $this->model = $model;
        $this->model_kriteria = $model_kriteria;
        $this->nameroutes = 'sub-kriteria';
        
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
                'title'             => 'Data Sub Kriteria',
                'breadcrumb'        => 'List Data Sub Kriteria',
                'headerModalTambah' => 'TAMBAH DATA SUB KRITERIA',
                'headerModalEdit'   => 'UBAH DATA SUB KRITERIA',
                'urlDatatables'     => 'sub-kriteria/datatables',
                'idDatatables'      => 'dt_sub_kriteria'
            );
            return view('sub_kriteria.datatable',$data);
    }

    public function create(Request $request)
    {
        $item = [
            'nama_sub_kriteria' => null,
        ];

        $data = array(
            'item'                  => (object) $item,
            'submit_url'            => url()->current(),
            'is_edit'               => FALSE,
            'nameroutes'            => $this->nameroutes,
            'kriteria'              => Kriteria_m::get()
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
                    "message" => 'Data sub kriteria berhasil dibuat',
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

        return view('sub_kriteria.form', $data);

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
            'item'           => $get_data,
            'is_edit'        => TRUE,
            'submit_url'     => url()->current(),
            'nameroutes'     => $this->nameroutes,
            'kriteria'       => Kriteria_m::get()
        ];

        //jika form sumbit
        if($request->post())
        {
            //request dari view
            $header = $request->input('f');
           //validasi dari model
           $validator = Validator::make( $header,[
                'kode_kriteria' => ['required'],
                'nama_sub_kriteria' => ['required'],
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
                    "message" => 'Data sub kriteria berhasil diperbarui',
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
        
        return view('sub_kriteria.form', $data);
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            #cek user sudah digunakan
            $this->model->update_data(['aktif' => 0], $id);
            DB::commit();

            $response = [
                "message" => 'Data sub kriteria berhasil dihapus',
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

    public function datatables_collection()
    {
        $data = $this->model->get_all();
        return Datatables::of($data)->make(true);
    }



}
