<form  method="POST" action="{{ url($submit_url) }}" class="form-horizontal" name="form_crud">
  {{ csrf_field() }}
  <div class="form-group">
    <label class="col-lg-3 control-label">ID Debitur *</label>
    <div class="col-lg-9">
      <input type="text" class="form-control" name="f[id_debitur]" id="id_debitur" value="{{ @$item->id_debitur }}" placeholder="ID Debitur" required="" readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Nama Debitur *</label>
    <div class="col-lg-9">
      <input type="text" class="form-control" name="f[nama_debitur]" id="nama_debitur" value="{{ @$item->nama_debitur }}" placeholder="Nama Debitur" required="">
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Alamat *</label>
    <div class="col-lg-9">
      <input type="text" name="f[alamat_debitur]" id="alamat_debitur" class="form-control" placeholder="Alamat" value="{{ @$item->alamat_debitur }}">
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Telepon *</label>
    <div class="col-lg-9">
      <input type="text" name="f[telepon]" id="telepon" class="form-control" placeholder="No Telepon" value="{{ @$item->telepon }}">
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Tanggal Lahir *</label>
    <div class="col-lg-9">
      <input type="date" name="f[tanggal_lahir]" id="tanggal_lahir" class="form-control" placeholder="Tanggal Lahir" value="{{ @$item->tanggal_lahir }}">
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Jenis Kelamin *</label>
    <div class="col-lg-9">
      <select name="f[jenis_kelamin]" class="form-control" required="" id="jenis_kelamin">
        <option value="" disabled="" selected="" hidden="">-- Pilih --</option>
        <?php foreach(@$option_jenis_kelamin as $dt): ?>
          <option value="<?php echo @$dt['id'] ?>" <?= @$dt['id'] == @$item->jenis_kelamin ? 'selected': null ?>><?php echo @$dt['desc'] ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Pekerjaan *</label>
    <div class="col-lg-9">
      <input type="text" name="f[pekerjaan]" id="pekerjaan" class="form-control" placeholder="Pekerjaan" value="{{ @$item->pekerjaan }}">
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Username *</label>
    <div class="col-lg-9">
      <input type="text" name="u[username]" id="username" class="form-control" placeholder="Username" value="{{ @$item->username }}" required="">
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Password *</label>
    <div class="col-lg-9">
      <input type="password" name="u[password]" id="password" class="form-control" placeholder="Password" value="{{ @$item->password }}" required="">
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
  $('form[name="form_crud"]').on('submit',function(e) {
    e.preventDefault();

    $('.btn-save').addClass('disabled', true);
    $(".spinner").css("display", "");

    var data_post = new FormData($(this)[0]);
    $.ajax({
        url: $(this).prop('action'),
        type: 'POST',              
        data: data_post,
        contentType : false,
        processData : false,
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