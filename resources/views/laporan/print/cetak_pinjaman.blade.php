<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ @$title }} {{config('app.app_name')}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="shortcut icon" href="{{url('themes/default/images/favicon.ico')}}">
    <link rel="stylesheet" href="{{ url('themes/default/css/style_report.css')}}">
</head>
<body>
  <table style="border:none;">
    <tr>
      {{-- <td width="100px" style="border:none;"><img src="{{ url('themes/login/images/logo.png')}}" alt="" style="width: 100px;text-align:center"><br></td> --}}
      <td style="border:none;">
        <h4 align="center">
          <span style="font: 18px">{{config('app.app_alias')}}</span><br>
          Alamat : {{config('app.address')}} <br>Telepon : {{config('app.phone')}}
        </h4>
      </td>
      {{-- <td width="100px" style="border:none;"><img src="{{ url('themes/login/images/logo_pendidikan.png')}}" alt="" style="width: 100px;text-align:center"><br></td> --}}
    </tr>
  </table>
  <hr>
    <h5 align="center">
      <u>{{ @$title }}</u> <br>
      Periode : {{ date('d-m-Y', strtotime($params->date_start)) ." s/d ". date('d-m-Y', strtotime($params->date_end)) }}
    </h5>
    <div class="container">
        <table width="100%">
          <thead>
            <tr>
              <th style="text-align: center!important">No</th>
              <th>ID Pinjaman</th>
              <th>Tgl Pinjaman</th>
              <th>Nama Debitur</th>
              <th>Jumlah Pinjaman</th>
              <th>Jangka Waktu</th>
              <th>Jaminan</th>
              <th>Pendapatan Perbulan</th>
              <th>Riwayat Meminjam</th>
              <th>Pekerjaan</th>
              <th>Jenis Pinjaman</th>
            </tr>
          </thead>
          <tbody>
            <?php  $no = 1; ?>
            @if(!$item->isEmpty()) 
              @foreach($item as $row)
                <tr>
                  <td align="center">{{ $no++ }}</td>
                  <td>{{ $row->id_pinjaman }}</td>
                  <td>{{ date('d M Y',strtotime($row->tanggal_pinjaman)) }}</td>
                  <td>{{ $row->nama_debitur }}</td>
                  <td>{{ $row->jumlah_pinjaman }}</td>
                  <td>{{ $row->jangka_waktu }}</td>
                  <td>{{ $row->jaminan }}</td>
                  <td>{{ $row->pendapatan_perbulan }}</td>
                  <td>{{ $row->riwayat_meminjam }}</td>
                  <td>{{ $row->pekerjaan }}</td>
                  <td>{{ $row->jenis_pinjaman }}</td>
                </tr>
              @endforeach
            @else
              <tr>
                <td colspan="11" align="center">Tidak terdapat data</td>
              </tr>
            @endif
          </tbody>
          <tfoot>
           
          </tfoot>
        </table>
      </div>
    <p style="z-index: 100;position: absolute;bottom: 0px;float: right;font-size: 11px;"><i>Tanggal Cetak : <?php echo date('d-m-Y') ?></i></p>
</body>
</html>