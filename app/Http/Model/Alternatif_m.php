<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Alternatif_m extends Model
{
	protected $table = 'tb_alternatif';
	protected $index_key = 'id';
	protected $index_key2 = 'kode_alternatif';
    public $timestamps  = false;

	public $rules;

    public function __construct()
	{
        $this->rules = [
            'insert' => [
                'kode_alternatif' => "required|unique:$this->table",
				'id_debitur' => "required",
            ],
			'update' => [
				'id_debitur' => 'required',
            ],
        ];
	}

    function get_all()
    {
		$query = DB::table("{$this->table} as a")
				->join('tb_debitur as b','a.id_debitur','=','b.id')
				->where('a.aktif', 1)
				->select(
					'a.*',
					'b.nama_debitur',
					'b.alamat_debitur',
					'b.telepon'
				);
				
		return $query->get();
    }

    function insert_data($data)
	{
		return self::insert($data);
	}

	function get_one($id)
	{
		$query = DB::table("{$this->table} as a")
				->join('tb_debitur as b','a.id_debitur','=','b.id')
				->select(
					'a.*',
					'b.nama_debitur',
					'b.alamat_debitur',
					'b.telepon'
				)
				->where("a.{$this->index_key}", $id);
				
		return $query->first();
	}

	function get_by( $where )
	{
		$query = DB::table("{$this->table} as a")
				->join('tb_debitur as b','a.id_debitur','=','b.id')
				->select(
					'a.*',
					'b.nama_debitur',
					'b.alamat_debitur',
					'b.telepon'
				)
				->where($where);
				
		return $query->first();
	}

	function get_by_in( $where, $data )
	{
		return self::whereIn($where, $data)->get();
	}

	function update_data($data, $id)
	{
		return self::where($this->index_key, $id)->update($data);
	}

	function update_by($data, Array $where)
	{
		$query = DB::table($this->table)->where($where);
		return $query->update($data);
	}

	function gen_code( $format )
	{
		$query = self::count();
		$number = $query+1;
		$no_generate = $format . (string) $number;
		return $no_generate;
	}

}
