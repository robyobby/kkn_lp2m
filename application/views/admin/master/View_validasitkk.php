<!-- page content -->
<div class="right_col" role="main">
   <div class="">
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_title">
                  <h2>Data Mahasiswa TKK </h2>
                  <ul class="nav navbar-right panel_toolbox">
                     <li>
                        <button class="btn btn-success btn-sm" type="button" id="downloadTemplate" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-download"></i> Template <span class="caret"></span></button>
                        <ul role="menu" class="dropdown-menu">
                           <form action="<?= site_url('ValidasiTKK/excelMahasiswa') ?>" method="POST">
                              <input type="hidden" name="filter_data" value="<?= set_value('filter') ?>">
                              <li><button type="submit" class="btn btn-link")><i class="fa fa-user"></i> Mahasiswa</button></li>
                           </form>
                           <form action="<?= site_url('ValidasiTKK/excelDosen') ?>" method="POST">
                              <li><button type="submit" class="btn btn-link")><i class="fa fa-users"></i> Dosen</a></li>
                           </form>
                        </ul>
                        <button class="btn btn-success btn-sm" type="button" id="importTemplate"><i class="fa fa-recycle"></i> Import</button>
                     </li>
                     <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                     </li>
                  </ul>

                  <div class="clearfix"></div>
               </div>
               <form action="<?= site_url('ValidasiTKK/filter') ?>" method="post">
                  <div class="x_title">
                     <h2>Filter </h2>
                     <div class="col-md-3 col-sm-3 col-xs-3">
                        <select class="form-control" name="filter" id="filter" value="<?= set_value('filter') ?>" required>
                           <option value="0">--Semua--</option>
                           <option value="1">Ada Penguji</option>
                           <option value="2">Belum Ada Penguji</option>
                        </select>
                        <button class="btn btn-primary btn-sm" type="submit" id="bukaModal"><i class="fa fa-filter"></i> Filter</button>
                     </div>
                     <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                     <table id="myDataTable" class="table table-striped table-bordered bulk_action display">
                        <thead>
                           <tr>
                              <th>
                              </th>
                              <th>NIM</th>
                              <th style="display: none;">NIM 2</th>
                              <th>Nama</th>
                              <th>Tanggal Daftar</th>
                              <th>Fakultas - Program Studi</th>
                              <th>No Telepon</th>
                              <th>Aksi</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           $no = 1;
                           foreach ($dataTKKaktif as  $row => $data) : ?>
                              <tr>
                                 <td class="text-center"> <?= $no++; ?>.</td>
                                 <td>
                                    <?= $data['nim']; ?> <br>
                                    <?php
                                    if ($data['kode_dosen'] == null) { ?>
                                       <div class="label label-warning">Belum ada penguji</div>
                                    <?php } else { ?>
                                       <div class="label label-info">Non Aktif</div>
                                    <?php } ?>
                                 </td>
                                 <td style="display: none;"><?= $data['nim']; ?></td>
                                 <td><?= $data['nama']; ?></td>
                                 <td><?= $data['tanggal_daftar']; ?></td>
                                 <td>(<?= $data['fakultas']; ?>)<br><?= $data['prodi']; ?></td>
                                 <td><?= $data['notelp']; ?></td>
                                 <td><a class="btn btn-warning btn-xs" id="tombolvalidasitkk" data-toggle="modal" data-target="#modal-validasitkk" data-kode_tkk_daftar="<?= $data['kode_tkk_daftar'] ?>" data-kode_dosen="<?= $data['kode_dosen'] ?>" data-nim="<?= $data['nim'] ?>" data-nama="<?= $data['nama'] ?>" data-fakultas="<?= $data['fakultas'] ?>" data-prodi="<?= $data['prodi'] ?>"><i class="fa fa-edit"></i></a></td>
                              </tr>
                           <?php endforeach; ?>
                        </tbody>
                     </table>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- /page content -->

<div class="modal fade" id="modal-edittahapantkk" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
         </div>
         <div class="modal-body" id="edittahapantkk">
            <div class="x_title">
               <h2>Edit Tahapan TKK <small>Administrator</small></h2>
               <div class="clearfix"></div>
            </div>
            <div class="x_content form-horizontal form-label-left">
               <form action="<?= site_url('Datatkkperiode/edit_tkkperiode') ?>" method="POST">
                  <div class="item form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Semester <span class="required">*</span></label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="semester_ta" name="semester_ta" class="form-control col-md-7 col-xs-12" readonly>
                        <input type="hidden" id="kode_tkk_tahap" name="kode_tkk_tahap" readonly required>
                        <input type="hidden" id="kode_semester" name="kode_semester" readonly required>
                        <input type="hidden" id="status_aktif_tahapan_tkk" name="status_aktif" readonly required>
                     </div>
                  </div>
                  <div class="item form-group">
                     <label  label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tahapan ke - <span class="required">*</span></label>
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
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="waktu_pembukaan">Waktu Pembukaan<span class="required">*</span></label>
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