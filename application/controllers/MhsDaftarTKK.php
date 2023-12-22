<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MhsDaftarTKK extends CI_Controller
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
    $status_aktif = 1;
    $nim = $data['userMahasiswa']['nim'];
    $data['waktudaftar'] = $this->M_tkkperiode->ambil_baris_tkk_tahap($status_aktif)->row_array();
    $data['datamahasiswa'] = $this->M_mahasiswa->ambil_data($nim)->result_array();
    $zona = new DateTimeZone('Asia/Kuala_Lumpur');
    $sekarang = new DateTime('now', $zona);
    $waktusekarang = $sekarang->format('Y-m-d H:i:s');
    if (($waktusekarang > $data['waktudaftar']['waktu_pembukaan']) and ($waktusekarang < $data['waktudaftar']['waktu_penutupan'])) {
      // print_r($data['durasi']);
      $this->template->load('mahasiswa/View_template', 'mahasiswa/View_daftartkk', $data);
    } else {
      $this->template->load('mahasiswa/View_template', 'mahasiswa/View_daftartutup', $data);
    }
  }
  public function tutup()
  {
    $data['userMahasiswa'] = $this->session->userdata('userMahasiswa');
    $this->template->load('mahasiswa/View_template', 'mahasiswa/View_daftartutup', $data);
  }
}
