<!-- page content -->
<div class="right_col" role="main">
   <div class="">
      <div class="clearfix"></div>
      <div class="">
         <div class="x_panel">
            <div class="clearfix"></div>
            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
               <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Periode</a>
               </li>
               <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Tambah Periode</a>
               </li>
            </ul>
            <div id="myTabContent" class="tab-content">
               <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                  <div class="x_panel">
                     <div class="x_title">
                        <h2>Data Periode <small>Administrator</small></h2>
                        <div class="clearfix"></div>
                     </div>
                     <div class="x_content">
                        <table id="datatable-fixed-header" class="table table-striped table-bordered">
                           <thead>
                              <tr>
                                 <th class="text-center">No</th>
                                 <th>Kode Semester</th>
                                 <th>Semester</th>
                                 <th>Tahun Akademik</th>
                                 <th>Aksi</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php $no = 1;
                              foreach ($row->result() as $rows => $data) { ?>
                                 <tr>
                                    <td class="text-center"> <?= $no++; ?>.</td>
                                    <td>
                                       <?= $data->semester_akademik; ?>
                                       <?php
                                       if ($data->status_aktif == 1) { ?>
                                          <div class="label label-success">Aktif</div>
                                          <a href="<?= site_url('Dataperiode/ubah_status_nonaktif/' . $data->kode_semester) ?>"><input type="checkbox" class="js-switch" checked /></a> Status Aktif
                                       <?php } else { ?>
                                          <div class="label label-danger">Non Aktif</div>
                                          <a href="<?= site_url('Dataperiode/ubah_status_aktif/' . $data->kode_semester) ?>"><input type="checkbox" class="js-switch" /></a> Status Aktif
                                       <?php } ?>
                                    </td>
                                    <td><?= $data->semester; ?></td>
                                    <td><?= $data->tahun_akademik; ?></td>
                                    <td>
                                       <form action="">
                                          <a class="btn btn-warning btn-xs" id="tomboleditperiode" data-toggle="modal" data-target="#modal-editperiode" data-kode_semester="<?= $data->kode_semester ?>" data-semester_akademik="<?= $data->semester_akademik ?>" data-semester="<?= $data->semester ?>" data-tahun_akademik="<?= $data->tahun_akademik ?>" data-status_aktif="<?= $data->status_aktif ?>"><i class="fa fa-edit"> Edit</i></a>
                                          <input type="hidden" name="kode_semester" value="<?= $data->kode_semester ?>">
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
                        <h2>Tambah Data Periode <small>Administrator</small></h2>
                        <div class="clearfix"></div>
                     </div>
                     <div class="x_content">
                        <form class="form-horizontal form-label-left" action="<?= site_url('Dataperiode/tambah_periode') ?>" method="POST">
                           <div class="item form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kode Semester *</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                 <input id="semester_akademik" class="form-control col-md-7 col-xs-12" name="semester_akademik" placeholder="semester_akademik" required type="text" data-inputmask="'mask': '99999'">
                                 <?= form_error('semester_akademik', '<div class="alert alert-danger" role="alert">
				                     Password salah !', '</div>'); ?>
                              </div>
                           </div>
                           <div class="item form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Semester *</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                 <select class="form-control" name="semester" id="semester">
                                    <option>-Pilih Semester-</option>
                                    <option value="Ganjil" <?= set_value('semester') == "Ganjil" ? "selected" : null ?>>Ganjil</option>
                                    <option value="Genap" <?= set_value('semester') == "Genap" ? "selected" : null ?>>Genap</option>
                                 </select>
                              </div>   
                           </div>
                           <div class="item form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tahun Akademik *</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                 <input id="tahun_akademik" class="form-control col-md-7 col-xs-12" name="tahun_akademik" placeholder="tahun_akademik" required type="text" data-inputmask="'mask': '9999/9999'">
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


<div class="modal fade" id="modal-editperiode" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
            </button>
         </div>
         <div class="modal-body" id="editperiode">
            <div class="x_title">
               <h2>Tambah Data Periode <small>Administrator</small></h2>
               <div class="clearfix"></div>
            </div>
            <div class="x_content form-horizontal form-label-left">
               <form action="<?= site_url('Dataperiode/edit_periode') ?>" method="POST">
                  <div class="item form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Semester <span class="required">*</span>
                     </label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="semeter" id="semester">
                           <option>-Pilih Semester-</option>
                           <option value="Ganjil">Ganjil</option>
                           <option value="Genap">Genap</option>
                        </select>
                     </div>
                  </div>
                  <div class="item form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tahun_akademik" placeholder="tahun_akademik">Tahun Akademik <span class="required">*</span>
                     </label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="tahun_akademik" name="tahun_akademik" class="form-control col-md-7 col-xs-12" data-inputmask="'mask': '9999/9999'">
                        <input type="hidden" id="kode_semester" name="kode_semester" required>
                        <input type="hidden" id="status_aktif" name="status_aktif" required>
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