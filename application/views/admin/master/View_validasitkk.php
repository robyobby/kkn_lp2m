<!-- page content -->
<div class="right_col" role="main">
   <div class="">
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
            <?= $this->session->flashdata('pesan'); ?>
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
                     </li>
                     <li>
                        <form action="<?= site_url('ValidasiTKK/importValidasi') ?>" method="POST" enctype="multipart/form-data">
                           <button class="btn btn-success btn-sm" type="submit" id="importTemplate"><i class="fa fa-recycle"></i> Import</button>
                           <input type="file" name="excel_file" accept=".xls, .xlsx">
                        </form>
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
                     <input type="text" id="cari_dosen" name="cari_dosen" class="form-control col-md-7 col-xs-12" placeholder="Cari Dosen....." required>
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
                           foreach ($dataTKKaktif as  $row => $item) : ?>
                              <tr>
                                 <td class="text-center"> <?= $no++; ?>.</td>
                                 <td>
                                    <?= $item -> nim; ?> <br>
                                    <?php
                                    if ($item->kode_dosen == null) { ?>
                                       <div class="label label-warning">Belum ada penguji</div>
                                    <?php } else { ?>
                                       <div class="label label-info">Sudah ada penguji</div>
                                    <?php } ?>
                                 </td>
                                 <td style="display: none;"><?= $item->nim; ?></td>
                                 <td><?= $item->nama; ?></td>
                                 <td><?= $item->tanggal_daftar; ?></td>
                                 <td>(<?= $item->fakultas; ?>)<br><?= $item->prodi; ?></td>
                                 <td><?= $item->notelp; ?></td>
                                 <td><a class="btn btn-warning btn-xs" id="tombolvalidasitkk" data-toggle="modal" data-target="#modal-validasitkk" data-kode_tkk_daftar="<?= $item->kode_tkk_daftar ?>" data-kode_dosen="<?= $item->kode_dosen ?>" data-nim="<?= $item->nim ?>" data-nama="<?= $item->nama ?>" data-fakultas="<?= $item->fakultas ?>" data-prodi="<?= $item->prodi ?>"><i class="fa fa-edit"></i></a></td>
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

<div class="modal fade" id="modal-validasitkk" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
         </div>
         <div class="modal-body" id="validasitkk">
            <div class="x_title">
               <h2>Tambahkan Penguji <small>Administrator</small></h2>
               <div class="clearfix"></div>
            </div>
            <div class="x_content form-horizontal form-label-left">
               <form action="<?= site_url('ValidasiTKK/tambah_penguji') ?>" method="POST">
                  <div class="item form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nim">NIM <span class="required">*</span></label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="nim" name="nim" class="form-control col-md-7 col-xs-12" readonly>
                        <input type="hidden" id="kode_tkk_daftar" name="kode_tkk_tahap" readonly required>
                     </div>
                  </div>
                  <div class="item form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama <span class="required">*</span></label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="nama" name="nama" class="form-control col-md-7 col-xs-12" readonly>
                     </div>
                  </div>
                  <div class="item form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fakultas">Fakultas <span class="required">*</span></label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="fakultas" name="fakultas" class="form-control col-md-7 col-xs-12" readonly>
                     </div>
                  </div>
                  <div class="item form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="prodi">Program Studi <span class="required">*</span></label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="prodi" name="prodi" class="form-control col-md-7 col-xs-12" readonly>
                     </div>
                  </div>
                  <div class="ln_solid"></div>
                  <div class="item form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cari_dosen">Nama Dosen <span class="required">*</span></label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="cari_dosen" name="cari_dosen" class="form-control col-md-7 col-xs-12" placeholder="Cari Dosen....." required>
                        <input type="hidden" id="kode_dosen" name="kode_dosen" class="form-control col-md-7 col-xs-12" readonly>
                     </div>
                  </div>
                  <div class="item form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nip">NIP <span class="required">*</span></label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="nip" name="nip" class="form-control col-md-7 col-xs-12" readonly>
                     </div>
                  </div>
                  <div class="item form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jabatan">Jabatan <span class="required">*</span></label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="jabatan" name="jabatan" class="form-control col-md-7 col-xs-12" readonly>
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