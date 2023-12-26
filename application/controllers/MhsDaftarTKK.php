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
    $data['datamahasiswa'] = $this->M_mahasiswa->ambil_data($nim)->row_array();
    $data['daftartkk'] = $this->M_tkkperiode->ambil_daftartkk($nim)->row_array();
    $zona = new DateTimeZone('Asia/Kuala_Lumpur');
    $sekarang = new DateTime('now', $zona);
    $waktusekarang = $sekarang->format('Y-m-d H:i:s');
    if (($waktusekarang > $data['waktudaftar']['waktu_pembukaan']) and ($waktusekarang < $data['waktudaftar']['waktu_penutupan'])) {
      $this->template->load('mahasiswa/View_template', 'mahasiswa/View_daftartkk', $data);
      // print_r($data['daftartkk']);
    } else {
      $this->template->load('mahasiswa/View_template', 'mahasiswa/View_daftartutup', $data);
    }
  }
  public function tutup()
  {
    $data['userMahasiswa'] = $this->session->userdata('userMahasiswa');
    $this->template->load('mahasiswa/View_template', 'mahasiswa/View_daftartutup', $data);
  }

  public function daftar()
  {
    $post = $this->input->post(null, TRUE);
    $zona = new DateTimeZone('Asia/Kuala_Lumpur');
    $sekarang = new DateTime('now', $zona);
    $post = array(
        'kode_tkk_tahap' => $this->security->sanitize_filename($this->security->xss_clean(html_escape($this->input->post('kode_tkk_tahap')))), 
        'kode_mahasiswa' => $this->security->sanitize_filename($this->security->xss_clean(html_escape($this->input->post('kode_mahasiswa')))), 
        'kode_dosen' => null, 
        'tanggal_daftar' => $sekarang->format('Y-m-d H:i:s'),
        'status_lulus' => 'tg',
        'nilai_n1' => null,
        'no_sertifikat' => null,
        'tanggal_expired' => null,
        'status_aktif' => $this->security->sanitize_filename($this->security->xss_clean(html_escape($this->input->post('status_aktif')))),
    );
    $this->M_mahasiswa->tambah_tkkdaftar($post);
    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('success', 'Anda Berhasil terdaftar sebagai peserta TKK !');
    }
    redirect('MhsDaftarTKK');
  }
}
