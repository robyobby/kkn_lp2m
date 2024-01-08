<!-- page content -->
<div class="right_col" role="main">
   <div class="">
      <div class="clearfix"></div>
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_title">
                  <h2>User Profile <small>Activity report</small></h2>
                  <div class="clearfix"></div>
               </div>
               <div class="x_content">
                  <div class="col-md-3 col-sm-3 col-xs-12 profile_left">

                     <h3><?= $userMahasiswa['name']; ?></h3>
                     <h4><?= $userMahasiswa['nim']; ?></h4>
                     <ul class="list-unstyled user_data">
                        <li><i class="fa fa-map-marker user-profile-icon"></i> <?= $userMahasiswa['kabupaten']; ?>, <?= $userMahasiswa['provinsi']; ?>
                        </li>
                        <li>
                           <i class="fa fa-briefcase user-profile-icon"></i> <?= $userMahasiswa['fakultas']; ?>
                        </li>
                        <li class="m-top-xs">
                           <i class="fa fa-external-link user-profile-icon"></i> <?= $userMahasiswa['jenjang']; ?> <?= $userMahasiswa['prodi']; ?>
                        </li>
                     </ul>
                     <?php
                     if (empty($mahasiswa['nim'])) : ?>
                        <!-- perintah edit -->
                        <form action="<?= site_url('MhsDashboard/tambah_mahasiswa') ?>" method="POST">
                           <input type="hidden" name="nim" value="<?= $userMahasiswa['nim']; ?>">
                           <input type="hidden" name="nama" value="<?= $userMahasiswa['name']; ?>">
                           <input type="hidden" name="jenjang" value="<?= $userMahasiswa['jenjang']; ?>">
                           <input type="hidden" name="fakultas" value="<?= $userMahasiswa['fakultas']; ?>">
                           <input type="hidden" name="prodi" value="<?= $userMahasiswa['prodi']; ?>">
                           <input type="hidden" name="alamat" value="<?= $userMahasiswa['jalan']; ?>, <?= $userMahasiswa['rt']; ?>, <?= $userMahasiswa['rw']; ?>, <?= $userMahasiswa['kabupaten']; ?>, <?= $userMahasiswa['provinsi']; ?>">
                           <input type="hidden" name="notelp" value="<?= $userMahasiswa['hp']; ?>">
                           <input type="hidden" name="jk" value="<?= $userMahasiswa['gender']; ?>">
                           <input type="hidden" name="email" value="<?= $userMahasiswa['email']; ?>">
                           <input type="hidden" name="status_aktif" value="1">
                           <button type="submit" class="btn btn-warning"><i class="fa fa-edit m-right-xs"></i> Sync Profile</button>
                        </form>
                     <?php else : ?>
                        <!-- perintah tambah -->
                        <form action="<?= site_url('MhsDashboard/edit_mahasiswa') ?>" method="POST">
                           <input type="hidden" name="nim" value="<?= $userMahasiswa['nim']; ?>">
                           <input type="hidden" name="nama" value="<?= $userMahasiswa['name']; ?>">
                           <input type="hidden" name="jenjang" value="<?= $userMahasiswa['jenjang']; ?>">
                           <input type="hidden" name="fakultas" value="<?= $userMahasiswa['fakultas']; ?>">
                           <input type="hidden" name="prodi" value="<?= $userMahasiswa['prodi']; ?>">
                           <input type="hidden" name="alamat" value="<?= $userMahasiswa['jalan']; ?>, <?= $userMahasiswa['rt']; ?>, <?= $userMahasiswa['rw']; ?>, <?= $userMahasiswa['kabupaten']; ?>, <?= $userMahasiswa['provinsi']; ?>">
                           <input type="hidden" name="notelp" value="<?= $userMahasiswa['hp']; ?>">
                           <input type="hidden" name="jk" value="<?= $userMahasiswa['gender']; ?>">
                           <input type="hidden" name="email" value="<?= $userMahasiswa['email']; ?>">
                           <input type="hidden" name="status_aktif" value="1">
                           <button type="submit" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i> Sync Profile</button>
                        </form>
                     <?php endif; ?>
                     <br />
                  </div>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                     <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                           <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Tes Keterampilan Keagamaan (TKK)</a>
                           </li>
                           <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Kuliah Kerja Nyata (KKN)</a>
                           </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                           <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                              <!-- start recent activity -->
                              <?php
                              foreach ($daftarTKK as $tkk => $data) : ?>
                                 <ul class="messages">
                                    <li>
                                       <div class="message_date">
                                          <h3 class="date text-error"><?= date("d", strtotime($data['tanggal_daftar'])); ?></h3>
                                          <p class="month"><?= date("F", strtotime($data['tanggal_daftar'])); ?></p>
                                       </div>
                                       <div class="message_wrapper">
                                          <h4 class="heading">Tahap ke <?= $data['tahap_ke']; ?> Semester <?= $data['semester']; ?> T.A. <?= $data['tahun_akademik']; ?></h4>
                                          <?php
                                          if ($data['status_lulus'] == 'l') : ?> <!--lulus -->
                                             <blockquote class="message">
                                                Selamat ! Anda telah lulus Tes Keterampilan Keagamaan pada tahap ini. Nilai dari TKK ini berlaku sampai tanggal <?= date("d F Y", strtotime($data['tanggal_expired'])); ?>. <br>
                                                <a class="btn btn-success" href="<?= base_url(); ?>application/uploads/sertifikat/<?= $data['semester_akademik'] ?>/<?= $data['tahap_ke'] ?>/<?= $data['no_sertifikat'] ?>.png" method="post" enctype="multipart/form-data" target="_blank"><i class="fa fa-edit m-right-xs"></i> Download Sertifikat</a>
                                                <!-- <a class="btn btn-success" href="<?= base_url(); ?>Sertifikat/arsip/<?= $data['no_sertifikat'] ?>.png" target="_blank"><i class="fa fa-edit m-right-xs"></i> Download Sertifikat</a> -->
                                             </blockquote>
                                          <?php elseif ($data['status_lulus'] == 'tl') : ?> <!--tidak lulus -->
                                             <blockquote class="message">Maaf ! Anda belum lulus untuk Tes Keterampilan pada Tahap ke <?= $data['tahap_ke']; ?> Semester <?= $data['semester']; ?> T.A. <?= $data['tahun_akademik']; ?></blockquote>
                                          <?php elseif ($data['status_lulus'] == 'tg') : ?> <!--menunggu -->
                                             <blockquote class="message">Selamat ! Anda telah terdaftar pada Tes Keterampilan Keagamaan pada Tahap ke <?= $data['tahap_ke']; ?> Semester <?= $data['semester']; ?> T.A. <?= $data['tahun_akademik']; ?> </blockquote>
                                          <?php endif; ?>
                                          <br />
                                          <p class="url">
                                             <span class="fs1" aria-hidden="true" data-icon=""></span>
                                             <!-- <a href="#" data-original-title="">Download</a> -->
                                          </p>
                                       </div>
                                    </li>
                                 </ul>
                              <?php endforeach; ?>
                              <!-- end recent activity -->

                           </div>
                           <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                              <!-- start user projects -->
                              <table class="data table table-striped no-margin">
                                 <thead>
                                    <tr>
                                       <th>#</th>
                                       <th>Project Name</th>
                                       <th>Client Company</th>
                                       <th class="hidden-phone">Hours Spent</th>
                                       <th>Contribution</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td>1</td>
                                       <td>New Company Takeover Review</td>
                                       <td>Deveint Inc</td>
                                       <td class="hidden-phone">18</td>
                                       <td class="vertical-align-mid">
                                          <div class="progress">
                                             <div class="progress-bar progress-bar-success" data-transitiongoal="35"></div>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>2</td>
                                       <td>New Partner Contracts Consultanci</td>
                                       <td>Deveint Inc</td>
                                       <td class="hidden-phone">13</td>
                                       <td class="vertical-align-mid">
                                          <div class="progress">
                                             <div class="progress-bar progress-bar-danger" data-transitiongoal="15"></div>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>3</td>
                                       <td>Partners and Inverstors report</td>
                                       <td>Deveint Inc</td>
                                       <td class="hidden-phone">30</td>
                                       <td class="vertical-align-mid">
                                          <div class="progress">
                                             <div class="progress-bar progress-bar-success" data-transitiongoal="45"></div>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>4</td>
                                       <td>New Company Takeover Review</td>
                                       <td>Deveint Inc</td>
                                       <td class="hidden-phone">28</td>
                                       <td class="vertical-align-mid">
                                          <div class="progress">
                                             <div class="progress-bar progress-bar-success" data-transitiongoal="75"></div>
                                          </div>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                              <!-- end user projects -->

                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- /page content -->