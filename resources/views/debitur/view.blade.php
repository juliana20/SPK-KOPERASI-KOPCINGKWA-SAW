<form  method="POST" action="" class="form-horizontal" name="form_crud">
  {{ csrf_field() }}
  <div class="form-group">
    <label class="col-lg-3 control-label">ID Debitur</label>
    <div class="col-lg-9">
      : <label class="control-label">{{ @$item->id_debitur }}</label>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Nama Debitur</label>
    <div class="col-lg-9">
      : <label class="control-label">{{ @$item->nama_debitur }}</label>
    </div>
  </div>
  <div class="form-group">
      <label class="col-lg-3 control-label">Alamat</label>
      <div class="col-lg-9">
        : <label class="control-label">{{ @$item->alamat_debitur }}</label>
      </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Telepon</label>
    <div class="col-lg-9">
      : <label class="control-label">{{ @$item->telepon }}</label>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Tanggal Lahir</label>
    <div class="col-lg-9">
      : <label class="control-label">{{ @$item->tanggal_lahir }}</label>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Jenis Kelamin</label>
    <div class="col-lg-9">
      : <label class="control-label">{{ (@$item->jenis_kelamin == 'L') ? 'Laki-Laki':'Perempuan'  }}</label>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Pekerjaan</label>
    <div class="col-lg-9">
      : <label class="control-label">{{ @$item->pekerjaan }}</label>
    </div>
  </div>
</form>
      
