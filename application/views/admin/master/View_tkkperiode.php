<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="">
      <div class="x_panel">
        <div class="clearfix"></div>
        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
          <li role="presentation" class="active"><a href="#tab_content1" id="tahapan-tab" role="tab" data-toggle="tab" aria-expanded="true">Tahapan TKK</a>
          </li>
          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="tambahtahaptkk-tab" data-toggle="tab" aria-expanded="false">Tambah Data</a>
          </li>
          <li role="presentation" class=""><a href="#tab_content3" role="tab" id="historitkk-tab" data-toggle="tab" aria-expanded="false">Riwayat Data</a>
          </li>
        </ul>
        <div id="myTabContent" class="tab-content">
          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
            <div class="x_panel">
              <div class="x_title">
                <h2>Data Periode TKK <small>Administrator</small></h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <table id="datatable-fixed-header" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th>Tahapan TKK</th>
                      <th>Waktu Pembukaan</th>
                      <th>Waktu Penutupan</th>
                      <th>Periode</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($tkkrow->result_array() as  $row => $data) : ?>
                      <tr>
                        <td class="text-center"> <?= $no++; ?>.</td>
                        <td>
                          Tahap ke - <?= $data['tahap_ke']; ?>
                          <?php
                          if ($data['status_aktif_tahapan_tkk'] == 1) { ?>
                            <div class="label label-success">Aktif</div>
                            <a href="<?= site_url('Datatkkperiode/ubah_status_nonaktif/' . $data['kode_tkk_tahap']) ?>"><input type="checkbox" class="js-switch" checked /></a>
                          <?php } else { ?>
                            <div class="label label-danger">Non Aktif</div>
                            <a href="<?= site_url('Datatkkperiode/ubah_status_aktif/' . $data['kode_tkk_tahap']) ?>"><input type="checkbox" class="js-switch" /></a>
                          <?php } ?>
                        </td>
                        <td><?= $data['waktu_pembukaan']; ?></td>
                        <td><?= $data['waktu_penutupan']; ?></td>
                        <td>
                          Semester <?= $data['semester']; ?> T.A. <?= $data['tahun_akademik']; ?>
                          <?php
                          if ($data['status_aktif_semester'] == 1) { ?>
                            <div class="label label-success">Aktif</div>
                          <?php } else { ?>
                            <div class="label label-danger">Non Aktif</div>
                          <?php } ?>
                        </td>
                        <td>
                          <form action="">
                            <a class="btn btn-warning btn-xs" id="tomboledittahapantkk" data-toggle="modal" data-target="#modal-edittahapantkk" data-kode_tkk_tahap="<?= $data['kode_tkk_tahap'] ?>" data-kode_semester="<?= $data['kode_semester'] ?>" data-status_aktif_tahapan_tkk="<?= $data['status_aktif_tahapan_tkk'] ?>" data-waktu_pembukaan="<?= $data['waktu_pembukaan'] ?>" data-waktu_penutupan="<?= $data['waktu_penutupan'] ?>" data-tahap_ke="<?= $data['tahap_ke'] ?>" data-status_aktif_tahapan_tkk="<?= $data['status_aktif_tahapan_tkk'] ?>" data-semester_ta="Semester <?= $data['semester']; ?> T.A. <?= $data['tahun_akademik']; ?>"><i class="fa fa-edit"> Edit</i></a>
                          </form>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
            <div class="x_panel">
              <div class="x_title">
                <h2>Tambah Data Periode <small>Administrator</small></h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <form class="form-horizontal form-label-left" action="s" method="POST">
                  <?php
                  foreach ($semesterrow as $row => $data) : ?>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Semester <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="semester_ta" name="semester_ta" class="form-control col-md-7 col-xs-12" readonly value="Semester <?= $data['semester']; ?> T.A. <?= $data['tahun_akademik']; ?>">
                        <input type="hidden" id="kode_semester" name="kode_semester" required value="<?= $data["kode_semester"]; ?>">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tahapan ke - <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="tahap_ke" id="tahap_ke" required>
                          <option>-Pilih Tahap TKK-</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                        </select>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="waktu_pembukaan" placeholder="waktu_pembukaan">Waktu Pembukaan<span class="required">*</span>
                      </label>
                      <div class="col-md-3 col-sm-3 col-xs-3">
                        <input type="datetime-local" id="waktu_pembukaan" name="waktu_pembukaan" class="form-control col-md-6 col-xs-6" required>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="waktu_penutupan" placeholder="waktu_pembukaan">Waktu Penutupan<span class="required">*</span>
                      </label>
                      <div class="col-md-3 col-sm-3 col-xs-3">
                        <input type="datetime-local" id="waktu_penutupan" name="waktu_penutupan" class="form-control col-md-6 col-xs-6" required>
                      </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                        <button id="send" type="submit" class="btn btn-success">Tambah</button>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="clearfix"></div>
</div>


<div class="modal fade" id="modal-edittahapantkk" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="edittahapantkk">
        <div class="x_title">
          <h2>Edit Tahapan TKK <small>Administrator</small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content form-horizontal form-label-left">
          <form action="<?= site_url('Datatkkperiode/edit_tkkperiode') ?>" method="POST">
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Semester <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="semester_ta" name="semester_ta" class="form-control col-md-7 col-xs-12" readonly>
                <input type="hidden" id="kode_tkk_tahap" name="kode_tkk_tahap" readonly required>
                <input type="hidden" id="kode_semester" name="kode_semester" readonly required>
                <input type="hidden" id="status_aktif_tahapan_tkk" name="status_aktif" readonly required>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tahapan ke - <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="tahap_ke" id="tahap_ke" required>
                  <option>-Pilih Tahap TKK-</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                </select>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="waktu_pembukaan">Waktu Pembukaan<span class="required">*</span>
              </label>
              <div class="col-md-3 col-sm-3 col-xs-3">
                <input type="datetime-local" id="waktu_pembukaan" name="waktu_pembukaan" class="form-control col-md-6 col-xs-6" required>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="waktu_penutupan">Waktu Penutupan<span class="required">*</span>
              </label>
              <div class="col-md-3 col-sm-3 col-xs-3">
                <input type="datetime-local" id="waktu_penutupan" name="waktu_penutupan" class="form-control col-md-6 col-xs-6" required>
              </div>
            </div>
            <div class="ln_solid"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">TUTUP</button>
          <button type="submit" class="btn btn-primary">UBAH</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->