<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\User_m;
use Validator;
use DataTables;
use DB;
use Response;

class UserController extends Controller
{
    protected $jabatan = [
        ['id' => 'Admin', 'desc' => 'Admin'],
        ['id' => 'Ketua', 'desc' => 'Ketua Koperasi'],
        // ['id' => 'Debitur', 'desc' => 'Debitur'],
    ];

    protected $jenis_kelamin = [
        ['id' => 'L', 'desc' => 'Laki-Laki'],
        ['id' => 'P', 'desc' => 'Perempuan']
    ];

    public function __construct()
    {
        $this->model = New User_m;
        $this->nameroutes = 'user';
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
                'title'             => 'Data Admin',
                'breadcrumb'        => 'List Data Admin',
                'headerModalTambah' => 'TAMBAH DATA ADMIN',
                'headerModalEdit'   => 'UBAH DATA ADMIN',
                'headerModalDetail' => 'DETAIL DATA ADMIN',
                'urlDatatables'     => 'user/datatables',
                'idDatatables'      => 'dt_user'
            );
            return view('user.datatable',$data);
    }

    public function create(Request $request)
    {
        $item = [
            'id_pengguna' => $this->model->gen_code('U'),
            'nama' => null,
            'username' => null,
            'password' => null,
            'jabatan' => null,
        ];

        $data = array(
            'item'                  => (object) $item,
            'submit_url'            => url()->current(),
            'is_edit'               => FALSE,
            'option_jabatan'        => $this->jabatan,
            'option_jenis_kelamin'  => $this->jenis_kelamin,
            'nameroutes'            => $this->nameroutes,
        );

        //jika form sumbit
        if($request->post())
        {
            $header = array_merge($item, $request->input('f'));
            $header['password'] = bcrypt($header['password']);

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
                    "message" => 'Data admin berhasil dibuat',
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

        return view('user.form', $data);

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
            'option_jabatan'            => $this->jabatan,
            'option_jenis_kelamin'  => $this->jenis_kelamin,
            'nameroutes'                => $this->nameroutes,
        ];

        //jika form sumbit
        if($request->post())
        {
            //request dari view
            $header = $request->input('f');

           //validasi dari model
           $validator = Validator::make( $header, $this->model->rules['update']);
           if ($validator->fails()) {
               $response = [
                   'message' => $validator->errors()->first(),
                   'status' => 'error',
                   'code' => 500,
               ];
               return Response::json($response);
           }

            $tb_user = [
                'username'      => $header['username'],
                'nama' => $header['nama'],
                'jabatan'       => $header['jabatan']
            ];
            //cek password berubah/tidak
            if($header['password'] != $get_data->password)
            {
                $tb_user['password'] = bcrypt($header['password']);
            }

            //insert data
            DB::beginTransaction();
            try {
                $this->model->update_data($tb_user, $id);
                DB::commit();

                $response = [
                    "message" => 'Data admin berhasil diperbarui',
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
        
        return view('user.form', $data);
    }

    public function view($id)
    {
        $get_data = $this->model->get_one($id);
        $data = [
            'item'                      => $get_data,
            'is_edit'                   => TRUE,
            'submit_url'                => url()->current(),
            'option_jabatan'            => $this->jabatan,
            'option_jenis_kelamin'      => $this->jenis_kelamin,
            'nameroutes'                => $this->nameroutes,
        ];
        
        return view('user.view', $data);
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            #cek user sudah digunakan
            $this->model->update_data(['aktif' => 0], $id);
            DB::commit();

            $response = [
                "message" => 'Data pengguna berhasil dihapus',
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
