<form  method="POST" action="{{ url($submit_url) }}" class="form-horizontal" name="form_crud">
  {{ csrf_field() }}
  <div class="form-group">
    <label class="col-lg-3 control-label">ID Pinjaman *</label>
    <div class="col-lg-9">
      <input type="text" class="form-control" name="f[id_pinjaman]" id="id_pinjaman" value="{{ @$item->id_pinjaman }}" placeholder="ID Pinjaman" required="" readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Nama Debitur *</label>
    <div class="col-lg-9">
      <div class="input-group data_collect_wrapper">
        <input type="text" name="nama_debitur" id="nama_debitur" class="form-control" placeholder="Nama Debitur" value="{{ @$item->nama_debitur }}" required="" readonly>
        <input type="hidden" name="f[id_debitur]" id="id_debitur" class="form-control" placeholder="ID Debitur" value="{{ @$item->id_debitur }}" required="" readonly>
        <div class="input-group-btn">
          <a href="javascript:;" id="lookup_debitur" class="btn btn-info btn-flat data_collect_btn"><i class="fa fa-search"></i> Cari</a>
        </div>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Tanggal Pinjaman *</label>
    <div class="col-lg-9">
      <input type="date" name="f[tanggal_pinjaman]" id="tanggal_pinjaman" class="form-control" placeholder="Tanggal Pinjaman" value="{{ @$item->tanggal_pinjaman }}">
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Jaminan *</label>
    <div class="col-lg-9">
      <select name="f[jaminan]" class="form-control" required="" id="jaminan">
        <option value="" disabled="" selected="" hidden="">-- Pilih --</option>
        <?php foreach(@$jaminan as $dt): ?>
          <option value="<?php echo @$dt->id ?>" <?= @$dt->id == @$item->jaminan ? 'selected': null ?>><?php echo @$dt->nama_sub_kriteria ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Jumlah Pinjaman *</label>
    <div class="col-lg-9">
      <select name="f[jumlah_pinjaman]" class="form-control" required="" id="jumlah_pinjaman">
        <option value="" disabled="" selected="" hidden="">-- Pilih --</option>
        <?php foreach(@$jumlah_pinjaman as $dt): ?>
          <option value="<?php echo @$dt->id ?>" <?= @$dt->id == @$item->jumlah_pinjaman ? 'selected': null ?>><?php echo @$dt->nama_sub_kriteria ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Pekerjaan *</label>
    <div class="col-lg-9">
      <select name="f[pekerjaan]" class="form-control" required="" id="pekerjaan">
        <option value="" disabled="" selected="" hidden="">-- Pilih --</option>
        <?php foreach(@$pekerjaan as $dt): ?>
          <option value="<?php echo @$dt->id ?>" <?= @$dt->id == @$item->pekerjaan ? 'selected': null ?>><?php echo @$dt->nama_sub_kriteria ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Jenis Pinjaman *</label>
    <div class="col-lg-9">
      <select name="f[jenis_pinjaman]" class="form-control" required="" id="jenis_pinjaman">
        <option value="" disabled="" selected="" hidden="">-- Pilih --</option>
        <?php foreach(@$jenis_pinjaman as $dt): ?>
          <option value="<?php echo @$dt->id ?>" <?= @$dt->id == @$item->jenis_pinjaman ? 'selected': null ?>><?php echo @$dt->nama_sub_kriteria ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Pendapatan Perbulan *</label>
    <div class="col-lg-9">
      <select name="f[pendapatan_perbulan]" class="form-control" required="" id="pendapatan_perbulan">
        <option value="" disabled="" selected="" hidden="">-- Pilih --</option>
        <?php foreach(@$pendapatan_perbulan as $dt): ?>
          <option value="<?php echo @$dt->id ?>" <?= @$dt->id == @$item->pendapatan_perbulan ? 'selected': null ?>><?php echo @$dt->nama_sub_kriteria ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Riwayat Meminjam *</label>
    <div class="col-lg-9">
      <select name="f[riwayat_meminjam]" class="form-control" required="" id="riwayat_meminjam">
        <option value="" disabled="" selected="" hidden="">-- Pilih --</option>
        <?php foreach(@$riwayat_meminjam as $dt): ?>
          <option value="<?php echo @$dt->id ?>" <?= @$dt->id == @$item->riwayat_meminjam ? 'selected': null ?>><?php echo @$dt->nama_sub_kriteria ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Jangka Waktu *</label>
    <div class="col-lg-9">
      <select name="f[jangka_waktu]" class="form-control" required="" id="jangka_waktu">
        <option value="" disabled="" selected="" hidden="">-- Pilih --</option>
        <?php foreach(@$jangka_waktu as $dt): ?>
          <option value="<?php echo @$dt->id ?>" <?= @$dt->id == @$item->jangka_waktu ? 'selected': null ?>><?php echo @$dt->nama_sub_kriteria ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="form-group">
      <div class="col-lg-offset-3 col-lg-9">
        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('global.label_close') }}</button>
        <button id="submit_form" type="submit" class="btn btn-success btn-save">@if($is_edit) {{ __('global.label_update') }} @else {{ __('global.label_save') }} @endif <i class="fas fa-spinner fa-spin spinner" style="display: none"></i></button> 
      </div>
  </div>
</form>
      

<script type="text/javascript">
	$( document ).ready(function(e) {
    mask_number.init()

    $('#lookup_debitur').dataCollect({
        ajaxUrl: "{{ url('debitur/datatables') }}",
        modalSize : 'modal-lg',
        modalTitle : 'DAFTAR PILIHAN NASABAH',
        modalTxtSelect : 'Pilih Nasabah',
        dtOrdering : true,
        dtOrder: [],
        dtThead:['ID Debitur','Nama Debitur','Telepon','Alamat'],
        dtColumns: [
            {data: "id_debitur"}, 
            {data: "nama_debitur"}, 
            {data: "telepon"}, 
            {data: "alamat_debitur"}, 
        ],
        onSelected: function(data, _this){	
          $('#id_debitur').val(data.id);
          $('#nama_debitur').val(data.nama_debitur);
          $('#alamat_debitur').val(data.alamat_debitur); 
          return true;
        }
    });

  });

  $('form[name="form_crud"]').on('submit',function(e) {
    e.preventDefault();

    $('.btn-save').addClass('disabled', true);
    $(".spinner").css("display", "");

    var post_pengajuan = {
          'id_debitur'    : $("#id_debitur").val(),
          'tanggal_pinjaman' : $("#tanggal_pinjaman").val(),
          'jaminan' : $("#jaminan").val(),
          'jumlah_pinjaman' : $("#jumlah_pinjaman").val(),
          'pekerjaan' : $("#pekerjaan").val(),
          'jenis_pinjaman' : $("#jenis_pinjaman").val(),
          'pendapatan_perbulan' : $("#pendapatan_perbulan").val(),
          'riwayat_meminjam' : $("#riwayat_meminjam").val(),
          'jangka_waktu' : $("#jangka_waktu").val(),
        }
     data_post = {
          "f" : post_pengajuan,
        }

    $.ajax({
        url: $(this).prop('action'),
        type: 'POST',              
        data: data_post,
        success: function(response, status, xhr)
        {
          if( response.status == "error"){
              $.alert_warning(response.message);
              $('.btn-save').removeClass('disabled', true);
              $(".spinner").css("display", "none");
              return false
          }
            
          $.alert_success(response.message);
              setTimeout(function(){
                document.location.href = "{{ url("$nameroutes") }}";        
              }, 500);  
          },
        error: function(error)
        {
          $.alert_error(error);
          $('.btn-save').removeClass('disabled', true);
          $(".spinner").css("display", "none");
          return false
        }
    });
});
</script>