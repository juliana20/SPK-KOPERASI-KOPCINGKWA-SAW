<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Proses_spk_m extends Model
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
				'id_pinjaman' => "required|unique:$this->table",
            ],
			'update' => [
				'id_pinjaman' => 'required',
            ],
        ];
	}

    function get_all()
    {
		$query = DB::table("{$this->table} as a")
				->join('tb_pinjaman as b','a.id_pinjaman','=','b.id')
				->join('tb_debitur as c','b.id_debitur','=','c.id')
				->join('tb_sub_kriteria as d','b.jaminan','=','d.id')
				->join('tb_sub_kriteria as e','b.jumlah_pinjaman','=','e.id')
				->join('tb_sub_kriteria as f','b.pekerjaan','=','f.id')
				->join('tb_sub_kriteria as g','b.jenis_pinjaman','=','g.id')
				->join('tb_sub_kriteria as h','b.pendapatan_perbulan','=','h.id')
				->join('tb_sub_kriteria as i','b.riwayat_meminjam','=','i.id')
				->join('tb_sub_kriteria as j','b.jangka_waktu','=','j.id')
				->select(
					'a.*',
					'b.id as pinjaman_id',
					'b.id_pinjaman',
					'b.id_debitur',
					'c.nama_debitur',
					'c.alamat_debitur',
					'c.telepon',
					'e.bobot as C1',
					'j.bobot as C2',
					'd.bobot as C3',
					'h.bobot as C4',
					'i.bobot as C5',
					'f.bobot as C6',
					'g.bobot as C7'
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
				->join('tb_pinjaman as b','a.id_pinjaman','=','b.id')
				->join('tb_debitur as c','b.id_debitur','=','c.id')
				->select(
					'a.*',
					'b.id as pinjaman_id',
					'b.id_pinjaman',
					'b.id_debitur',
					'c.nama_debitur',
					'c.alamat_debitur',
					'c.telepon'
				)
				->where("a.{$this->index_key}", $id);
				
		return $query->first();
	}

	function get_by( $where )
	{
		$query = DB::table("{$this->table} as a")
				->join('tb_pinjaman as b','a.id_pinjaman','=','b.id')
				->join('tb_debitur as c','b.id_debitur','=','c.id')
				->select(
					'a.*',
					'b.id as pinjaman_id',
					'b.id_pinjaman',
					'b.id_debitur',
					'c.nama_debitur',
					'c.alamat_debitur',
					'c.telepon'
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
		$max_number = self::all()->max($this->index_key2);
		$noUrut = (int) substr($max_number, 6, 6);
		$noUrut++;
		$code = $format;
		$no_generate = $code . sprintf("%06s", $noUrut);

		return (string) $no_generate;
	}

}