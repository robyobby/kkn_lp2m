<!DOCTYPE html>
<html lang="en">

<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <!-- Meta, title, CSS, favicons, etc. -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <title>Gentelella Alela! | </title>

   <!-- Bootstrap -->
   <link href="<?= base_url() ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- Font Awesome -->
   <link href="<?= base_url() ?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
   <!-- NProgress -->
   <link href="<?= base_url() ?>assets/vendors/nprogress/nprogress.css" rel="stylesheet">
   <!-- Sweetalert -->
   <link href="<?= base_url() ?>assets/vendors/sweetalert/sweetalert2.min.css" rel="stylesheet">
   <!-- iCheck -->
   <link href="<?= base_url() ?>assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
   <!-- Switchery -->
   <link href="<?= base_url() ?>assets/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
   <!-- bootstrap-progressbar -->
   <link href="<?= base_url() ?>assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
   <!-- JQVMap -->
   <link href="<?= base_url() ?>assets/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
   <!-- bootstrap-daterangepicker -->
   <link href="<?= base_url() ?>assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
   <!-- Custom Theme Style -->
   <link href="<?= base_url() ?>assets/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
   <div class="container body">
      <div class="main_container">
         <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
               <div class="navbar nav_title" style="border: 0;">
                  <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
               </div>
               <div class="clearfix"></div>
               <br />
               <!-- sidebar menu -->
               <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                  <div class="menu_section">
                     <h3>Halaman</h3>
                     <ul class="nav side-menu">
                        <li><a href="<?= base_url('Dashboard') ?>"><i class="fa fa-home"></i> Dashboard <span class="fa fa-chevron"></span></a>
                     </ul>
                  </div>
                  <div class="menu_section">
                     <h3>Setting</h3>
                     <ul class="nav side-menu">
                        <li><a><i class="fa fa-desktop"></i> Data Master <span class="fa fa-chevron-down"></span></a>
                           <ul class="nav child_menu">
                              <li><a href="<?= base_url('Datauser') ?>"><i class="fa fa-user"></i> User <span class="fa fa-chevron"></span></a>
                              <li><a href="<?= base_url('Dataperiode') ?>"><i class="fa fa-calendar"></i> Periode <span class="fa fa-chevron"></span></a>
                              <li><a><i class="fa fa-calendar-o"></i> Data Tahapan <span class="fa fa-chevron-down"></span></a>
                                 <ul class="nav child_menu">
                                    <li><a href="<?= base_url('Datatkkperiode') ?>"><i class="fa fa-calendar-o"></i> Periode TKK <span class="fa fa-chevron"></span></a>
                                    <li><a href="<?= base_url('Datakknperiode') ?>"><i class="fa fa-calendar-o"></i> Periode KKN <span class="fa fa-chevron"></span></a>
                                 </ul>
                              </li>
                           </ul>
                        </li>
                     </ul>
                  </div>
               </div>
               <!-- /sidebar menu -->
            </div>
         </div>

         <!-- top navigation -->
         <div class="top_nav">
            <div class="nav_menu">
               <nav>
                  <div class="nav toggle">
                     <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                  </div>

                  <ul class="nav navbar-nav navbar-right">
                     <li class="">
                        <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                           John Doe
                           <span class=" fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-usermenu pull-right">
                           <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                        </ul>
                     </li>
                  </ul>
               </nav>
            </div>
         </div>
         <!-- /top navigation -->

         <!-- page content -->
         <?= $contents; ?>
         <!-- /page content -->

         <!-- footer content -->
         <footer>
            <div class="pull-right">
               Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
            </div>
            <div class="clearfix"></div>
         </footer>
         <!-- /footer content -->
      </div>
   </div>

   <!-- jQuery -->
   <script src="<?= base_url() ?>assets/vendors/jquery/dist/jquery.min.js"></script>
   <!-- Bootstrap -->
   <script src="<?= base_url() ?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
   <!-- FastClick -->
   <script src="<?= base_url() ?>assets/vendors/fastclick/lib/fastclick.js"></script>
   <!-- NProgress -->
   <script src="<?= base_url() ?>assets/vendors/nprogress/nprogress.js"></script>
   <!-- validator -->
   <script src="<?= base_url() ?>assets/vendors/validator/validator.js"></script>
   <!-- Chart.js -->
   <script src="<?= base_url() ?>assets/vendors/Chart.js/dist/Chart.min.js"></script>
   <!-- gauge.js -->
   <script src="<?= base_url() ?>assets/vendors/gauge.js/dist/gauge.min.js"></script>
   <!-- bootstrap-progressbar -->
   <script src="<?= base_url() ?>assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
   <!-- iCheck -->
   <script src="<?= base_url() ?>assets/vendors/iCheck/icheck.min.js"></script>
   <!-- Skycons -->
   <script src="<?= base_url() ?>assets/vendors/skycons/skycons.js"></script>
   <!-- Flot -->
   <script src="<?= base_url() ?>assets/vendors/Flot/jquery.flot.js"></script>
   <script src="<?= base_url() ?>assets/vendors/Flot/jquery.flot.pie.js"></script>
   <script src="<?= base_url() ?>assets/vendors/Flot/jquery.flot.time.js"></script>
   <script src="<?= base_url() ?>assets/vendors/Flot/jquery.flot.stack.js"></script>
   <script src="<?= base_url() ?>assets/vendors/Flot/jquery.flot.resize.js"></script>
   <!-- Flot plugins -->
   <script src="<?= base_url() ?>assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
   <script src="<?= base_url() ?>assets/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
   <script src="<?= base_url() ?>assets/vendors/flot.curvedlines/curvedLines.js"></script>
   <!-- DateJS -->
   <script src="<?= base_url() ?>assets/vendors/DateJS/build/date.js"></script>
   <!-- Switchery -->
   <script src="<?= base_url() ?>assets/vendors/switchery/dist/switchery.min.js"></script>
   <!-- JQVMap -->
   <script src="<?= base_url() ?>assets/vendors/jqvmap/dist/jquery.vmap.js"></script>
   <script src="<?= base_url() ?>assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
   <script src="<?= base_url() ?>assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
   <!-- bootstrap-daterangepicker -->
   <script src="<?= base_url() ?>assets/vendors/moment/min/moment.min.js"></script>
   <script src="<?= base_url() ?>assets/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
   <!-- jquery.inputmask -->
   <script src="<?= base_url() ?>assets/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
   <!-- Sweetalert -->
   <script src="<?= base_url() ?>assets/build/js/modules-sweetalert.js"></script>
   <script src="<?= base_url() ?>assets/vendors/sweetalert/dist/sweetalert.min.js"></script>
   <script src="<?= base_url() ?>assets/vendors/sweetalert/dist/sweetalert2.min.js"></script>
   <!-- Custom Theme Scripts -->
   <script src="<?= base_url() ?>assets/build/js/custom.min.js"></script>
   <!-- Datatables -->
   <script src="<?= base_url() ?>assets/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
   <script src="<?= base_url() ?>assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
   <script src="<?= base_url() ?>assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
   <script src="<?= base_url() ?>assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
   <script src="<?= base_url() ?>assets/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
   <script src="<?= base_url() ?>assets/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
   <script src="<?= base_url() ?>assets/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
   <script src="<?= base_url() ?>assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
   <script src="<?= base_url() ?>assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
   <script src="<?= base_url() ?>assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
   <script src="<?= base_url() ?>assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
   <script src="<?= base_url() ?>assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
   <script src="<?= base_url() ?>assets/vendors/jszip/dist/jszip.min.js"></script>
   <script src="<?= base_url() ?>assets/vendors/pdfmake/build/pdfmake.min.js"></script>
   <script src="<?= base_url() ?>assets/vendors/pdfmake/build/vfs_fonts.js"></script>


   <!-- My JS -->
   <script>
      <?php if ($this->session->flashdata('success')) { ?>
         var isi = <?php echo json_encode($this->session->flashdata('success')) ?>;
         Swal.fire({
            icon: 'success',
            title: 'Berhasil !',
            text: isi,
         })
      <?php } elseif ($this->session->flashdata('warning')) { ?>
         var isi = <?php echo json_encode($this->session->flashdata('warning')) ?>;

         Swal.fire({
            icon: 'warning',
            title: 'Gagal !',
            text: isi,
         })
      <?php } ?>
      $('.btn-hapus').on('click', function(e) {
         e.preventDefault();
         const href = $(this).attr('href');
         Swal.fire({
            title: 'Yakin ingin dihapus?',
            text: "Data akan terhapus apabila memilih ya!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya, hapus!'
         }).then((result) => {
            if (result.value) {
               document.location.href = href;
            }
         })
      })

      $('.btn-valid').on('click', function(e) {
         e.preventDefault();
         const href = $(this).attr('href');
         Swal.fire({
            title: 'Yakin ingin divalidasi?',
            text: "Data akan tervalidasi apabila memilih ya!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya, valid!'
         }).then((result) => {
            if (result.value) {
               document.location.href = href;
            }
         })
      })

      $('.btn-aktif').on('click', function(e) {
         e.preventDefault();
         const href = $(this).attr('href');
         Swal.fire({
            title: 'Apakah anda yakin mengaktifkan Data User ini?',
            text: "Data User akan aktif apabila memilih ya!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya, Aktif!'
         }).then((result) => {
            if (result.value) {
               document.location.href = href;
            }
         })
      })

      $('.btn-nonaktif').on('click', function(e) {
         e.preventDefault();
         const href = $(this).attr('href');
         Swal.fire({
            title: 'Apakah anda yakin menonaktifkan Data User ini?',
            text: "Data User akan non aktif apabila memilih ya!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya, Nonaktif!'
         }).then((result) => {
            if (result.value) {
               document.location.href = href;
            }
         })
      })
   </script>

   <script>
      $(document).ready(function() {
         $(document).on('click', '#tomboledituser', function() {
            var kode_user = $(this).data('kode_user');
            var nama = $(this).data('nama');
            var email = $(this).data('email');
            var status_aktif = $(this).data('status_aktif');
            $('#edituser #kode_user').val(kode_user);
            $('#edituser #nama').val(nama);
            $('#edituser #email').val(email);
            $('#edituser #status_aktif').val(status_aktif);
         })
      })
   </script>

   <script>
      $(document).ready(function() {
         $(document).on('click', '#tomboleditperiode', function() {
            var kode_semester = $(this).data('kode_semester');
            var semester_akademik = $(this).data('semester_akademik');
            var semester = $(this).data('semester');
            var tahun_akademik = $(this).data('tahun_akademik');
            var status_aktif = $(this).data('status_aktif');
            $('#editperiode #kode_semester').val(kode_semester);
            $('#editperiode #semester_akademik').val(semester_akademik);
            $('#editperiode #semester').val(semester);
            $('#editperiode #tahun_akademik').val(tahun_akademik);
            $('#editperiode #status_aktif').val(status_aktif);
         })
      })
   </script>

<!-- <script>
   $(document).ready(function () {
        // Inisialisasi modal
      $('#modal-editperiode').modal('hide');
        // Menggunakan Ajax untuk mengirim formulir ke server
      $('#submitBtn').click(function () {
            var formData = $('#myForm').serialize();
            $.ajax({
               type: 'POST',
               url: '<?= site_url('Dataperiode/edit_periode') ?>',
               data: formData,
               success: function (response) {
                   // Tampilkan pesan atau lakukan tindakan sesuai respons dari server
                  alert(response);
               }
            });
      });
   });
</script> -->


</body>

</html>