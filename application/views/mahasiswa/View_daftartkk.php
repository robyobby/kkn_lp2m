<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <!-- <div id="countdown"></div> -->
            <h2>Pendaftaran <small>Sisa Waktu : </small><small class="label label-warning" id="countdown"></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <p>Silahkan Daftar Tes Keterampilan Keagamaan, Data dibawah adalah data diri anda sesuai di SIAKAD </p>
            <form id="daftarTKK" action="<?= site_url('MhsDaftarTKK/daftar') ?>" method="POST" class="form-horizontal form-label-left">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">NIM <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="nim" name="nim" value="<?= $datamahasiswa['nim']; ?>" class="form-control col-md-7 col-xs-12" readonly required>
                  <input type="hidden" id="kode_mahasiswa" value="<?= $datamahasiswa['kode_mahasiswa']; ?>" name="kode_mahasiswa" required>
                  <input type="hidden" id="kode_tkk_tahap" value="<?= $waktudaftar['kode_tkk_tahap']; ?>" name="kode_tkk_tahap" required>
                  <input type="hidden" id="tanggal_daftar" value="<?= $waktudaftar['kode_tkk_tahap']; ?>" name="kode_tkk_tahap" required>
                  <input type="hidden" id="status_aktif" value="1" name="status_aktif" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Nama <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="nama" name="nama" value="<?= $datamahasiswa['nama']; ?>" readonly required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Jejang <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="jenjang" name="jenjang" value="<?= $datamahasiswa['jenjang']; ?>" readonly required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Fakultas <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="fakultas" name="fakultas" value="<?= $datamahasiswa['fakultas']; ?>" readonly required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Program Studi <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="prodi" name="prodi" value="<?= $datamahasiswa['prodi']; ?>" readonly required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Jenis Kelamin <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="jk" name="jk" value="<?= $datamahasiswa['jk']; ?>" readonly required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">No Telp <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="notelp" name="notelp" value="<?= $datamahasiswa['notelp']; ?>" readonly required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
              <?php
              if (empty($daftartkk['nim'])) : ?>
                <div class="col-md-6 col-md-offset-3">
                  <button type="submit" class="btn btn-success btn-daftar">Daftar</button>
                </div>
                <?php else : ?>
                  <div class="col-md-6 col-md-offset-3">
                    <button type="button" class="btn btn-info" disable>Anda Telah Terdaftar</button>
                  </div>
              <?php endif; ?>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->