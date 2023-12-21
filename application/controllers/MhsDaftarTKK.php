<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MhsDaftarTKK extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model(['M_mahasiswa']);
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
  $this->template->load('mahasiswa/View_template', 'mahasiswa/View_daftartkk', $data);
}
}