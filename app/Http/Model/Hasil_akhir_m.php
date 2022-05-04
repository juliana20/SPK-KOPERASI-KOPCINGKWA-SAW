<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Hasil_akhir_m extends Model
{
	protected $table = 'tb_hasil';
	protected $index_key = 'id';
    public $timestamps  = false;

	public $rules;

    public function __construct()
	{

	}

    function get_all()
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
				->orderBy('b.tanggal_pinjaman', 'desc');

		return $query->get();
    }

    function insert_data($data)
	{
		return self::insert($data);
	}

	function get_one($id)
	{
		return self::where($this->index_key, $id)->first();
	}

	function get_by( $where )
	{

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
		$query = self::where($where);
		return $query->update($data);
	}

}
