<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Hasil_normalisasi_m extends Model
{
	protected $table = 'tb_hasil_normalisasi';
	protected $index_key = 'id';
    public $timestamps  = false;

	public $rules;

    public function __construct()
	{

	}

    function get_all()
    {
		return self::get();
    }

	function get_normalisasi()
    {
		return DB::table('tb_hasil_normalisasi')->get();
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
		$query = DB::table($this->table)->where($where);
		return $query->update($data);
	}

}
