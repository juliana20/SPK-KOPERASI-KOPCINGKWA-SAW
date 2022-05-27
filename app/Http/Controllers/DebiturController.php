<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Debitur_m;
use App\Http\Model\User_m;
use Validator;
use DataTables;
use Illuminate\Validation\Rule;
use DB;
use Response;

class DebiturController extends Controller
{
    protected $jenis_kelamin = [
        ['id' => 'L', 'desc' => 'Laki-Laki'],
        ['id' => 'P', 'desc' => 'Perempuan'],
    ];

    public function __construct()
    {
        $this->model = New Debitur_m;
        $this->model_user = New User_m;
        $this->nameroutes = 'debitur';
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
            'title'             => 'Data Debitur',
            'breadcrumb'        => 'List Data Debitur',
            'headerModalTambah' => 'TAMBAH DATA DEBITUR',
            'headerModalEdit'   => 'UBAH DATA DEBITUR',
            'headerModalDetail' => 'DETAIL DATA DEBITUR',
            'urlDatatables'     => 'debitur/datatables',
            'idDatatables'      => 'dt_debitur'
        );
        return view('debitur.datatable',$data);
    }

    public function create(Request $request)
    {
        $item = [
            'id_debitur'   => $this->model->gen_code('DB'),
            'nama_debitur' => null,
        ];
        $data = array(
            'item'                  => (object) $item,
            'submit_url'            => url()->current(),
            'is_edit'               => FALSE,
            'option_jenis_kelamin'  => $this->jenis_kelamin,
            'nameroutes'            => $this->nameroutes,
        );
        //jika form sumbit
        if($request->post())
        {
            $header = $request->input('f');
            $user = $request->input('u');

            $user['id_pengguna'] = $this->model_user->gen_code('U');
            $user['jabatan'] = 'Debitur';
            $user['nama'] = $header['nama_debitur'];
            $user['telepon'] = $header['telepon'];
            $user['jenis_kelamin'] = $header['jenis_kelamin'];
            $user['alamat'] = $header['alamat_debitur'];
            $user['password'] = bcrypt($user['password']);

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
                $id_pengguna = User_m::insertGetId($user);
                $header['id_pengguna'] = $id_pengguna;
                $this->model->insert_data($header);
                DB::commit();
    
                $response = [
                    "message" => 'Data debitur berhasil dibuat',
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

        return view('debitur.form', $data);

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
            'option_jenis_kelamin'      => $this->jenis_kelamin,
            'nameroutes'                => $this->nameroutes,
        ];

        //jika form sumbit
        if($request->post())
        {
            //request dari view
            $header = $request->input('f');
            $user = $request->input('u');
           //validasi dari model
           $validator = Validator::make( $header, [
                'id_debitur' => [Rule::unique('tb_debitur')->ignore($get_data->id_debitur, 'id_debitur')],
            ]);
           if ($validator->fails()) {
               $response = [
                   'message' => $validator->errors()->first(),
                   'status' => 'error',
                   'code' => 500,
               ];
               return Response::json($response);
           }

            //cek password berubah/tidak
            if($user['password'] != $get_data->password)
            {
                $tb_user['password'] = bcrypt($user['password']);
            }

            $tb_user['username'] = $user['username'];
            $tb_user['nama'] = $header['nama_debitur'];
            $tb_user['alamat'] = $header['alamat_debitur'];
            $tb_user['telepon'] = $header['telepon'];
            $tb_user['jenis_kelamin'] = $header['jenis_kelamin'];
            //insert data
            DB::beginTransaction();
            try {

                if(empty($get_data->id_pengguna) || $get_data->id_pengguna == "")
                {
                    $tb_user['id_pengguna'] = $this->model_user->gen_code('U');
                    $tb_user['jabatan'] = 'Debitur';

                    $id_user = User_m::insertGetId($tb_user);
                    $header['id_pengguna'] = $id_user;
                    $this->model->update_data($header, $id);
                }else{
                    $this->model->update_data($header, $id);
                    $this->model_user->update_data($tb_user, $get_data->id_pengguna);
                }

                DB::commit();

                $response = [
                    "message" => 'Data debitur berhasil diperbarui',
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
        
        return view('debitur.form', $data);
    }

    public function view($id)
    {
        $get_data = $this->model->get_one($id);
        $data = [
            'item'                      => $get_data,
            'is_edit'                   => TRUE,
            'nameroutes'                => $this->nameroutes,
        ];

        return view('debitur.view', $data);
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            #cek user sudah digunakan
            $this->model->update_data(['aktif' => 0], $id);
            DB::commit();

            $response = [
                "message" => 'Data debitur berhasil dihapus',
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
