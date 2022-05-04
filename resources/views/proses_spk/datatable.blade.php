@extends('themes.AdminLTE.layouts.template')
@section('breadcrumb')  
  <h1>
    {{ @$title }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Master</a></li>
    <li class="active">{{ @$title }}</li>
  </ol>
@endsection
@section('content')  
<form  method="POST" action="{{ url('proses-spk/proses-normalisasi') }}" class="form-horizontal" name="form_proses_normalisasi">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">{{ @$title }}</h3>
      </div>
      <!-- /.box-header -->
      <div class="table-responsive">
        <div class="box-body">
          <table class="table table-striped table-bordered table-hover" id="dt_proses_spk" width="100%">   
              <thead>
                <tr>
                  <th class="no-sort">No</th>
                  <th></th>
                  <th>Alternatif</th>
                  <th>C1</th>
                  <th>C2</th>
                  <th>C3</th>
                  <th>C4</th>
                  <th>C5</th>
                  <th>C6</th>
                  <th>C7</th>
                </tr>
              </thead>
              <tbody>
              
            </tbody>
            </table>
           
        </div>
      </div>
      <div class="box-tools pull-right">
        <br>
        <div class="btn-group">
          <button id="submit_form" type="submit" class="btn btn-success btn-save">{{ "Proses Normalisasi" }} <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> <i class="fas fa-spinner fa-spin spinner" style="display: none"></i></button> 
        </div>
      </div>
    </div>

<!-- DataTable -->
<script type="text/javascript">
    let _datatables_show = {
      dt__datatables_show:function(){
        var _this = $("#dt_proses_spk");
            _datatable = _this.DataTable({		
              processing: true,
              serverSide: true,
              paginate: false,
              ordering: true,
              order: [],
              searching: false,
              info: false,
              responsive: true,								
              ajax: {
								url: "{{ url("{$urlDatatables}") }}",
								type: "POST",
								data: function(params){

									}
								},
              columns: [
                          {
                              data: "id",
                              className: "text-center",
                              render: function (data, type, row, meta) {
                                  return meta.row + meta.settings._iDisplayStart + 1;
                              }
                          },
                          { 
                              data: "id_pinjaman", 
                              visible:false,
                              render: function ( val, type, row ){
                                  return val
                                }
                          },
                          { 
                              data: "kode_alternatif", 
                              render: function ( val, type, row ){
                                  return val
                                }
                          },
                          { 
                              data: "C1", 
                              render: function ( val, type, row ){
                                  return val
                              }
                          },
                          { 
                              data: "C2", 
                              render: function ( val, type, row ){
                                  return val
                                }
                          },
                          { 
                              data: "C3", 
                              render: function ( val, type, row ){
                                  return val
                              }
                          },
                          { 
                              data: "C4", 
                              render: function ( val, type, row ){
                                  return val
                                }
                          },
                          { 
                              data: "C5", 
                              render: function ( val, type, row ){
                                  return val
                                }
                          },
                          { 
                              data: "C6", 
                              render: function ( val, type, row ){
                                  return val
                                }
                          },
                          { 
                              data: "C7", 
                              render: function ( val, type, row ){
                                  return val
                                }
                          }
                      ],
                      createdRow: function ( row, data, index ){		
       

                      }
                                                  
                  });
							
                  return _this;
				}
			}

$(document).ready(function() {
    _datatables_show.dt__datatables_show();
});

$('form[name="form_proses_normalisasi"]').on('submit',function(e) {
    e.preventDefault();
    if(!confirm("Apakah anda yakin memproses data ini?")) {
      return false;
    }

    $('.btn-save').addClass('disabled', true);
    $(".spinner").css("display", "");

    var data_post = {
          "details" : {},
      }

      $("#dt_proses_spk").DataTable().rows().data().each(function (value, index){
        var details_form = {
            'id' : value.id,
            'id_pinjaman' : value.id_pinjaman,
            'kode_alternatif' : value.kode_alternatif,
            'C1' : value.C1,
            'C2' : value.C2,
            'C3' : value.C3,
            'C4' : value.C4,
            'C5' : value.C5,
            'C6' : value.C6,
            'C7' : value.C7,
        }
        data_post.details[index] = details_form;
    });

    var table = $('#dt_proses_spk').DataTable();

    if ( ! table.data().any() ) {
        $.alert_error('Tidak terdapat data pengajuan');
        $('.btn-save').removeClass('disabled', true);
        $(".spinner").css("display", "none");
        return false
    }

  $.post($(this).attr("action"), data_post, function(response, status, xhr) {
      if( response.status == "error"){
          $.alert_warning(response.message);
              $('.btn-save').removeClass('disabled', true);
              $(".spinner").css("display", "none");
              return false
          }
          $.alert_success(response.message);
          setTimeout(function(){
            document.location.href = "{{ url('proses-spk/normalisasi') }}";        
          }, 500);  
      }).catch(error => {
            $.alert_error(error);
            $('.btn-save').removeClass('disabled', true);
              $(".spinner").css("display", "none");
                return false
      });
});
</script>
@endsection
 
