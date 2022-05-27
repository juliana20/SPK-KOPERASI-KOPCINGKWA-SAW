<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Pinjaman_m extends Model
{
	protected $table = 'tb_pinjaman';
	protected $index_key = 'id';
	protected $index_key2 = 'id_pinjaman';
    public $timestamps  = false;

	public $rules;

    public function __construct()
	{
        $this->rules = [
            'insert' => [
                'id_pinjaman' => "required|unique:$this->table",
				'tanggal_pinjaman' => 'required',
            ],
			'update' => [
				'tanggal_pinjaman' => 'required',
            ],
        ];
	}

	function get_all_lookup_alternatif()
	{
		$query = DB::table('tb_alternatif as a')
				->join('tb_debitur as b','a.id_debitur','=','b.id')
				->where('a.aktif', 1)
				->select(
					'a.*',
					'b.id_debitur as kode_debitur',
					'b.nama_debitur',
					'b.alamat_debitur'
				)
				->get();

				return $query;
	}

    function get_all()
    {
		$query = DB::table("{$this->table} as a")
				->join('tb_alternatif as xx','a.id_alternatif','=','xx.id')
				->join('tb_debitur as b','xx.id_debitur','=','b.id')
				->join('tb_sub_kriteria as c','a.jaminan','=','c.id')
				->join('tb_sub_kriteria as d','a.jumlah_pinjaman','=','d.id')
				->join('tb_sub_kriteria as e','a.pekerjaan','=','e.id')
				->join('tb_sub_kriteria as f','a.jenis_pinjaman','=','f.id')
				->join('tb_sub_kriteria as g','a.pendapatan_perbulan','=','g.id')
				->join('tb_sub_kriteria as h','a.riwayat_meminjam','=','h.id')
				->join('tb_sub_kriteria as i','a.jangka_waktu','=','i.id')
				->where('a.aktif', 1)
				->select(
					'xx.kode_alternatif',
					'a.id',
					'a.id_pinjaman',
					'a.tanggal_pinjaman',
					'b.nama_debitur',
					'b.alamat_debitur',
					'b.telepon',
					'c.nama_sub_kriteria as jaminan',
					'd.nama_sub_kriteria as jumlah_pinjaman',
					'e.nama_sub_kriteria as pekerjaan',
					'f.nama_sub_kriteria as jenis_pinjaman',
					'g.nama_sub_kriteria as pendapatan_perbulan',
					'h.nama_sub_kriteria as riwayat_meminjam',
					'i.nama_sub_kriteria as jangka_waktu'
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
				->join('tb_alternatif as xx','a.id_alternatif','=','xx.id')
				->join('tb_debitur as b','xx.id_debitur','=','b.id')
				->select('a.*','b.nama_debitur','b.alamat_debitur','b.telepon')
				->where("a.{$this->index_key}", $id);
				
		return $query->first();
	}

	function get_by( $where )
	{
		$query = DB::table("{$this->table} as a")
				->join('tb_alternatif as xx','a.id_alternatif','=','xx.id')
				->join('tb_debitur as b','xx.id_debitur','=','b.id')
				->select('a.*','b.nama_nasabah','b.alamat_nasabah','b.telepon')
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
