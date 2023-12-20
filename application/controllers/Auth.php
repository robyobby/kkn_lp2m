<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

   function __construct()
   {
      parent::__construct();
      $this->load->model('M_user');
   }

   public function index()
   {
      // $this->template->load('templates/View_template', 'templates/View_dashboard', FALSE);
      $this->load->view('templates/View_login');
   }

   public function proses()
   {
      $jenis_user = $this->input->post('jenis_user');
      // var_dump($jenis_user);
      if ($jenis_user == "Admin") {
         $this->form_validation->set_rules('password', 'Password', 'required', array(
            'required' => 'Password tidak boleh kosong'
         ));
         $this->form_validation->set_rules('email', 'Email', 'required', array(
            'required' => 'Email tidak boleh kosong'
         ));
         $this->form_validation->set_error_delimiters('<small><span class="text-danger">', '</small>');

         if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/View_login');
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
            Akun Admin </div>');
         } else {
            $this->_login();
         }
      } else {
         $this->form_validation->set_rules('password', 'Password', 'required', array(
            'required' => 'Password tidak boleh kosong'
         ));
         $this->form_validation->set_rules('email', 'Email', 'required', array(
            'required' => 'Email tidak boleh kosong'
         ));
         $this->form_validation->set_error_delimiters('<small><span class="text-danger">', '</small>');

         if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/View_login');
         } else {
            $this->_loginMahasiswa();
         }
      }
      // redirect('Auth');
   }

   private function _login()
   {
      $input_email = $this->input->post('email');
      $input_password = $this->input->post('password');

      $user = $this->db->get_where('master_user', ['email' => $input_email])->row_array();
      //jika user ada
      if ($user != null) {
         //jika status aktif
         if ($user['status_aktif'] == 1) {
            if (password_verify($input_password, $user['password'])) {
               $data = [
                  'kode_user' => $user['kode_user'],
                  'email' => $user['email'],
                  'nama' => $user['nama']
               ];

               $this->session->set_userdata($data);
               redirect('Dashboard');
            } else {
               $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
				Password salah ! </div>');
               redirect('Auth');
            }
         } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
				Email ini belum diaktivasi oleh admin ! </div>');
            redirect('Auth');
         }
      } else {
         $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
				Email tidak diregistrasi !
			</div>');
         redirect('Auth');
      }
   }

   private function _loginMahasiswa()
   {
      $userdata['username'] = $this->security->sanitize_filename($this->security->xss_clean(html_escape($this->input->post('email'))));
      $userdata['password'] = $this->security->xss_clean(html_escape($this->input->post('password')));

      $userdata = $this->M_user->APIMahasiswa($userdata);
      // print_r($userdata);
      // exit;
      if (!empty($userdata['data']['username'])) {

         // success
         // echo "Login";
         $userdataArr['username'] = $userdata['data']['username'];
         $userdataArr['nim'] = $userdata['data']['nim'];
         $userdataArr['name'] = $userdata['data']['name'];
         $userdataArr['gender'] = $userdata['data']['gender'];
         $userdataArr['email'] = $userdata['data']['email'];
         $userdataArr['avatar'] = $userdata['data']['avatar'];
         $userdataArr['jenjang'] = $userdata['data']['jenjang'];
         $userdataArr['prodi'] = $userdata['data']['prodi'];
         $userdataArr['fakultas'] = $userdata['data']['fakultas'];
         $userdataArr['hp'] = $userdata['data']['hp'];
         $userdataArr['jalan'] = $userdata['data']['jalan'];
         $userdataArr['rt'] = $userdata['data']['rt'];
         $userdataArr['rw'] = $userdata['data']['rw'];
         $userdataArr['dusun'] = $userdata['data']['dusun'];
         $userdataArr['kelurahan'] = $userdata['data']['kelurahan'];
         $userdataArr['kecamatan'] = $userdata['data']['kecamatan'];
         $userdataArr['kabupaten'] = $userdata['data']['kabupaten'];
         $userdataArr['provinsi'] = $userdata['data']['provinsi'];
         // print_r($userdataArr);
         // exit;
         $this->session->set_userdata('user', $userdataArr);
         // redirect(base_url());
         // die();
         $this->session->set_flashdata('pesanAPI', '<div class="alert alert-success" role="alert"> Login API Sukses ! </div>');
         redirect('Auth');
      } else {
         // fail
         $this->session->set_flashdata('pesanAPI', '<div class="alert alert-danger" role="alert"> Login API Gagal ! </div>');
         redirect('Auth');
         // $this->session->set_flashdata('Pesan', '<div class="alert alert-danger" role="alert">
         // Gagal ! </div>');
         // $this->session->set_flashdata('pesan', $userdata['password']);
         // // die();
         // redirect('Auth');
      }
      // $this->session->set_flashdata('pesan', $userdata['password']);
   }

   public function logout()
   {
      $params = array('kode_user', 'email', 'nama');
      $this->session->unset_userdata($params);
      redirect('');
   }
}
