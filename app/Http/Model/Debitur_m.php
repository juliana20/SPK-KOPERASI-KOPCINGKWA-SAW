<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Debitur_m extends Model
{
	protected $table = 'tb_debitur';
	protected $index_key = 'id';
	protected $index_key2 = 'id_debitur';
    public $timestamps  = false;

	public $rules;

    public function __construct()
	{
        $this->rules = [
            'insert' => [
                'id_debitur' 	=> 'required|unique:tb_debitur',
				'nama_debitur' 	=> 'required',
            ],
			'update' => [
				'nama_debitur' 	=> 'required',
            ],
        ];
	}

    function get_all()
    {
        return self::get();
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
		return self::where($where)->first();
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
		$max_number = self::all()->max($this->index_key2);
		$noUrut = (int) substr($max_number, 5, 5);
		$noUrut++;
		$code = $format;
		$no_generate = $code . sprintf("%05s", $noUrut);

		return (string) $no_generate;
	}


}
