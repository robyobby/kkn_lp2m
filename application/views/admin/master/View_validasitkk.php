<!-- page content -->
<div class="right_col" role="main">
   <div class="">
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_title">
                  <h2>Data Mahasiswa TKK</h2>
                  <ul class="nav navbar-right panel_toolbox">
                     <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                     </li>
                  </ul>
                  <div class="clearfix"></div>

               </div>
               <div class="x_content">
                  <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                     <thead>
                        <tr>
                           <th>
                           <th><input type="checkbox" id="check-all" class="flat"></th>
                           </th>
                           <th>NIM</th>
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
                              <td><input type="checkbox" id="check-all" class="flat"></td>
                              <td>
                                 <?= $data['nim']; ?> <br>
                                 <?php
                                 if ($data['kode_dosen'] == null) { ?>
                                    <div class="label label-warning">Belum ada penguji</div>
                                 <?php } else { ?>
                                    <div class="label label-info">Non Aktif</div>
                                 <?php } ?>
                              </td>
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
            </div>
         </div>

      </div>
   </div>
</div>
<!-- /page content -->