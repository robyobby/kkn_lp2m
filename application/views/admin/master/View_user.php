<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="">
      <div class="x_panel">
        <div class="clearfix"></div>
        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">User</a>
          </li>
          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Tambah User</a>
          </li>
        </ul>
        <div id="myTabContent" class="tab-content">
          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
            <div class="x_panel">
              <div class="x_title">
                <h2>Data User <small>Administrator</small></h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <table id="datatable-fixed-header" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Nama</th>
                      <th class="text-center">Email</th>
                      <th class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1;
                    foreach ($row->result() as $rows => $data) { ?>
                      <tr>
                        <td class="text-center"> <?= $no++; ?>.</td>
                        <td>
                          <?= $data->nama; ?>
                          <?php
                          if ($data->status_aktif == 1) { ?>
                            <div class="label label-success">Aktif</div>
                            <a class="btn-nonaktif" href="<?= site_url('Datauser/ubah_status_nonaktif/' . $data->kode_user) ?>"><input type="checkbox" class="js-switch" checked /></a> Status Aktif
                          <?php } else { ?>
                            <div class="label label-danger">Non Aktif</div>
                            <a class="btn-aktif" href="<?= site_url('Datauser/ubah_status_aktif/' . $data->kode_user) ?>"><input type="checkbox" class="js-switch" /></a> Status Aktif
                          <?php } ?>
                        </td>
                        <td><?= $data->email; ?></td>
                        <td>
                          <form action="">
                            <a class="btn btn-warning btn-xs" id="tomboledituser" data-toggle="modal" data-target="#modal-edituser" data-kode_user="<?= $data->kode_user ?>" data-nama="<?= $data->nama ?>" data-email="<?= $data->email ?>" data-status_aktif="<?= $data->status_aktif ?>"><i class="fa fa-edit"> Edit</i></a>
                            <input type="hidden" name="kode_user" value="<?= $data->kode_user ?>">
                          </form>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
            <div class="x_panel">
              <div class="x_title">
                <h2>Tambah User <small>Administrator</small></h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <form class="form-horizontal form-label-left" action="<?= site_url('Datauser/tambah_user') ?>" method="POST">
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama *</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="nama" class="form-control col-md-7 col-xs-12" name="nama" placeholder="nama lengkap" required type="text">
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email *</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="email" id="email" name="email" required class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="item form-group">
                    <label for="password" class="control-label col-md-3">Password</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="password1" type="password" name="password1" class="form-control col-md-7 col-xs-12" required="required">
                    </div>
                  </div>
                  <div class="item form-group">
                    <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Konfirmasi Password</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="password3" type="password" name="password3" class="form-control col-md-7 col-xs-12" required="required">
                    </div>
                  </div>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                      <button id="send" type="submit" class="btn btn-success">Submit</button>
                    </div>
                  </div>
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


<div class="modal fade" id="modal-edituser" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="edituser">
        <div class="x_title">
          <h2>Tambah User <small>Administrator</small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content form-horizontal form-label-left">
          <form action="<?= site_url('Datauser/edit_user') ?>" method="POST">
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="nama" class="form-control col-md-7 col-xs-12" name="nama" placeholder="nama lengkap" required="required" type="text">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email" placeholder="email">Email <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="email" id="email" name="email" class="form-control col-md-7 col-xs-12">
                <input type="hidden" id="kode_user" name="kode_user" required>
                <input type="hidden" id="status_aktif" name="status_aktif" required>
              </div>
            </div>
            <div class="item form-group">
              <label for="password" class="control-label col-md-3">Password</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="password" type="password" name="password" class="form-control col-md-7 col-xs-12" required="required">
              </div>
            </div>
            <div class="item form-group">
              <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Konfirmasi Password</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="password2" type="password" name="password2" class="form-control col-md-7 col-xs-12" required="required">
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