@extends('themes.AdminLTE.layouts.template')
@section('breadcrumb')  
  <h1>
    {{ @$title }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Master</a></li>
    <li><a href="{{ url('proses-spk/perhitungan-akhir') }}">Hasil Perhitungan</a></li>
    <li class="active">{{ @$title }}</li>
  </ol>
@endsection
@section('content')  
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Hasil Perangkingan</h3>
      </div>
      <div class="table-responsive">
        <div class="box-body">
          <table class="table table-striped table-bordered table-hover" id="dt_perangkingan" width="100%">   
              <thead>
                <tr>
                  <th class="no-sort">Rangking</th>
                  <th>Alternatif</th>
                  <th>Nama Debitur</th>
                  <th>C1</th>
                  <th>C2</th>
                  <th>C3</th>
                  <th>C4</th>
                  <th>C5</th>
                  <th>C6</th>
                  <th>C7</th>
                  <th>Hasil Akhir</th>
                  <th>Keputusan</th>
                </tr>
              </thead>
              <tbody>
              
            </tbody>
            </table>
          </div>
        </div>
      </div>
<!-- DataTable -->

<script type="text/javascript">
    let _datatables_perangkingan = {
      dt__datatables_perangkingan:function(){
        var _this = $("#dt_perangkingan");
            _datatable = _this.DataTable({		
              processing: true,
              serverSide: true,
              paginate: false,
              ordering: true,
              order: [9, 'desc'],
              searching: false,
              info: false,
              responsive: true,							
              ajax: {
								url: "{{ url('proses-spk/datatables-perhitungan-akhir') }}",
								type: "POST",
								data: function(params){

									}
								},
              columns: [
                          {
                              data: "id_pinjaman",
                              className: "text-center",
                              render: function (data, type, row, meta) {
                                  return meta.row + meta.settings._iDisplayStart + 1;
                              }
                          },
                          { 
                              data: "alternatif", 
                              render: function ( val, type, row ){
                                  return val
                                }
                          },
                          { 
                              data: "nama_debitur", 
                              render: function ( val, type, row ){
                                  return val
                                }
                          },
                          { 
                              data: "c1", 
                              render: function ( val, type, row ){
                                  return val
                                }
                          },
                          { 
                              data: "c2", 
                              render: function ( val, type, row ){
                                  return val
                                }
                          },
                          { 
                              data: "c3", 
                              render: function ( val, type, row ){
                                  return val
                                }
                          },
                          { 
                              data: "c4", 
                              render: function ( val, type, row ){
                                  return val
                                }
                          },
                          { 
                              data: "c5", 
                              render: function ( val, type, row ){
                                  return val
                                }
                          },
                          { 
                              data: "c6", 
                              render: function ( val, type, row ){
                                  return val
                                }
                          },
                          { 
                              data: "c7", 
                              render: function ( val, type, row ){
                                  return val
                                }
                          },
                          { 
                              data: "hasil_akhir", 
                              render: function ( val, type, row ){
                                  return '<label class="label label-danger">' + val + '</label>'
                                }
                          },
                          { 
                              data: "keputusan", 
                              render: function ( val, type, row ){
                                  return val
                                }
                          },
                      ],
                      createdRow: function ( row, data, index ){		
       

                      }
                                                  
                  });
							
                  return _this;
				}
			}

$(document).ready(function() {
    _datatables_perangkingan.dt__datatables_perangkingan();
});

</script>
@endsection
 
