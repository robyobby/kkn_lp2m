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
                        <button class="btn btn-primary btn-sm" type="button" id="openModalBtn"><i class="fa fa-plus-circle"></i> Penguji </button>
                        <input type="text" name="filter_data" value="<?= set_value('filter') ?>">
                        <button class="btn btn-success btn-sm" type="button" id="downloadTemplate" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-download"></i> Template <span class="caret"></span></button>
                        <ul role="menu" class="dropdown-menu">
                           <li><a href="<?= site_url('ValidasiTKK/excelMahasiswa') ?>"><i class="fa fa-user"></i> Mahasiswa</a></li>
                           <li><a href="<?= site_url('ValidasiTKK/excelDosen') ?>"><i class="fa fa-users"></i> Dosen</a></li>
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
                              <th><input type="checkbox" id="selectAll" class=""></th>
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
                                 <td><input type="checkbox" id="data-checkbox" class="data-checkbox" value="<?= $data['nim']; ?>"></td>
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
                                 <td><a href="#"><i class="fa fa-edit"></i></a></td>
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