<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MhsDashboard extends CI_Controller
{
   function __construct()
   {
      parent::__construct();
      $this->load->model(['M_mahasiswa', 'M_tkkperiode']);
      $userdataArr = $this->session->userdata('userMahasiswa');
      if (empty($userdataArr)) {
         $this->session->set_flashdata('msg', 'Mohon Login karena Sesi sudah habis');
         redirect('Auth');
         die();
      }
   }

   public function index()
   {
      $data['userMahasiswa'] = $this->session->userdata('userMahasiswa');
      $nim = $data['userMahasiswa']['nim'];
      $data['mahasiswa'] = $this->M_mahasiswa->ambil_data($nim)->row_array();
      $data['mahasiswaTKK'] = $this->M_tkkperiode->ambil_daftartkk($nim)->row_array();
      $data['daftarTKK'] = $this->M_mahasiswa->ambil_data_TKK($nim)->result_array();
      // print_r($data['daftarTKK']);
      $this->template->load('mahasiswa/View_template', 'mahasiswa/View_dashboard', $data);
   }

   public function tambah_mahasiswa()
   {
      $post = $this->input->post(null, TRUE);
      $post = array(
         'nim' => $this->security->sanitize_filename($this->security->xss_clean(html_escape($this->input->post('nim')))),
         'nama' => $this->security->sanitize_filename($this->security->xss_clean(html_escape($this->input->post('nama')))),
         'jenjang' => $this->security->sanitize_filename($this->security->xss_clean(html_escape($this->input->post('jenjang')))),
         'fakultas' => $this->security->sanitize_filename($this->security->xss_clean(html_escape($this->input->post('fakultas')))),
         'prodi' => $this->security->sanitize_filename($this->security->xss_clean(html_escape($this->input->post('prodi')))),
         'alamat' => $this->security->sanitize_filename($this->security->xss_clean(html_escape($this->input->post('alamat')))),
         'notelp' => $this->security->sanitize_filename($this->security->xss_clean(html_escape($this->input->post('notelp')))),
         'jk' => $this->security->sanitize_filename($this->security->xss_clean(html_escape($this->input->post('jk')))),
         'email' => $this->security->sanitize_filename($this->security->xss_clean(html_escape($this->input->post('email')))),
         'status_aktif' => $this->security->sanitize_filename($this->security->xss_clean(html_escape($this->input->post('status_aktif')))),
      );
      $this->M_mahasiswa->tambah_mahasiswa($post);
      // print_r($post);
      if ($this->db->affected_rows() > 0) {
         $this->session->set_flashdata('success', 'Data Berhasil Disinkronkan !');
      }
      redirect('MhsDashboard');
   }

   public function edit_mahasiswa()
   {
      $post = $this->input->post(null, TRUE);
      $nim =  $this->security->sanitize_filename($this->security->xss_clean(html_escape($this->input->post('nim'))));
      $post = array(
         'nama' => $this->security->sanitize_filename($this->security->xss_clean(html_escape($this->input->post('nama')))),
         'jenjang' => $this->security->sanitize_filename($this->security->xss_clean(html_escape($this->input->post('jenjang')))),
         'fakultas' => $this->security->sanitize_filename($this->security->xss_clean(html_escape($this->input->post('fakultas')))),
         'prodi' => $this->security->sanitize_filename($this->security->xss_clean(html_escape($this->input->post('prodi')))),
         'alamat' => $this->security->sanitize_filename($this->security->xss_clean(html_escape($this->input->post('alamat')))),
         'notelp' => $this->security->sanitize_filename($this->security->xss_clean(html_escape($this->input->post('notelp')))),
         'jk' => $this->security->sanitize_filename($this->security->xss_clean(html_escape($this->input->post('jk')))),
         'email' => $this->security->sanitize_filename($this->security->xss_clean(html_escape($this->input->post('email')))),
         'status_aktif' => $this->security->sanitize_filename($this->security->xss_clean(html_escape($this->input->post('status_aktif')))),
      );
      $this->M_mahasiswa->edit_mahasiswa($nim, $post);
      // print_r($post);
      $this->session->set_flashdata('success', 'Data Berhasil Disinkronkan !');
      redirect('MhsDashboard');
   }

   function arsip()
   {
      $data['userMahasiswa'] = $this->session->userdata('userMahasiswa');
      $nim = $data['userMahasiswa']['nim'];
      $data['daftarTKK'] = $this->M_mahasiswa->ambil_data_TKK($nim)->result_array();
      
      $daftarTKK['no_sertifikat'] = $this->uri->segment(3);
      header('Content-Type: image/png');
      readfile('./application/uploads/sertifikat/' . $daftarTKK['semester_akademik'] . '/' . $daftarTKK['tahap_ke'] . '/' . $daftarTKK['no_sertifikat'] . '.png');
   }
}
