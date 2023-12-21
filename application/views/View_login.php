<!DOCTYPE html>
<html lang="en">

<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <!-- Meta, title, CSS, favicons, etc. -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <title><?php $title ?></title>

   <!-- Bootstrap -->
   <link href="<?= base_url() ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- Font Awesome -->
   <link href="<?= base_url() ?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
   <!-- NProgress -->
   <link href="<?= base_url() ?>assets/vendors/nprogress/nprogress.css" rel="stylesheet">
   <!-- Animate.css -->
   <link href="<?= base_url() ?>assets/vendors/animate.css/animate.min.css" rel="stylesheet">

   <!-- Custom Theme Style -->
   <link href="<?= base_url() ?>assets/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
   <div>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
         <div class="animate form login_form">
            <section class="login_content">
               <form action="<?= site_url('Auth/proses') ?>" method="POST">
                  <h1>Login Form</h1>
                  <?= $this->session->flashdata('pesan'); ?>
                  <?= $this->session->flashdata('pesanAPI'); ?>
                  <?= $this->session->flashdata('msg'); ?>
                  <div>
                     <input type="text" name="email" class="form-control" placeholder="Email untuk Admin atau NIM untuk Mahasiswa">
                     <?= form_error('email') ?>
                  </div>
                  <div>
                     <input type="password" name="password" class="form-control" placeholder="Password atau Password di SIAKAD">
                     <?= form_error('password') ?>
                  </div>
                  <div>
                     <select class="form-control" name="jenis_user" id="jenis_user" required>
                        <option>-Pilih Jenis User-</option>
                        <option value="Admin">Admin</option>
                        <option value="Mahasiswa">Mahasiswa</option>
                     </select>
                  </div>
                  <div>
                     <button type="submit" class="btn btn-default submit">Log in</button>
                  </div>
                  <div class="clearfix"></div>
                  <div class="separator">
                     <div class="clearfix"></div>
                     <br />
                  </div>
               </form>
            </section>
         </div>
      </div>
   </div>
</body>

</html>