<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datauser extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    // check_not_login();
    $this->load->model(['M_user']);
    $this->load->library('form_validation');
  }

  public function index()
  {
    $data['row'] = $this->M_user->ambil_datauser();
    $this->template->load('templates/View_template', 'user/View_user', $data);
  }

  public function edit_user()
  {
    $post = $this->input->post(null, TRUE);

    $this->form_validation->set_rules('nama', 'Nama', 'required', array(
      'required' => 'Nama tidak boleh kosong'
    ));
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email', array(
      'required' => 'Email tidak boleh kosong',
      'valid_email' => 'Email tidak valid'
    ));
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|matches[password]');

    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('warning', 'Ada Kesalahan Dalam Mengisi !');
      redirect('Datauser');
    } else {
      $post = $this->input->post(null, TRUE);
      $this->M_user->edit($post);
      if ($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('success', 'Data Berhasil Diubah !');
      }
      redirect('Datauser');
    }
  }

  public function tambah_user()
  {
    $post = $this->input->post(null, TRUE);

    $this->form_validation->set_rules('nama', 'Nama', 'required', array(
      'required' => 'Nama tidak boleh kosong'
    ));
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email', array(
      'required' => 'Email tidak boleh kosong',
      'valid_email' => 'Email tidak valid'
    ));
    $this->form_validation->set_rules('password1', 'Password', 'required');
    $this->form_validation->set_rules('password3', 'Konfirmasi Password', 'required|matches[password1]');

    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('warning', 'Ada Kesalahan Dalam Mengisi !');
      redirect('Datauser');
    } else {
      $post = $this->input->post(null, TRUE);
      $post['status_aktif'] = 1;
      $this->M_user->tambah_user($post);
      if ($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('success', 'Data Berhasil Diubah !');
      }
      redirect('Datauser');
    }
  }

  public function ubah_status_aktif($kode_user)
  {
    $this->db->query("UPDATE master_user SET `status_aktif`= 1 WHERE kode_user = $kode_user");
    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('success', 'Data Berhasil Diaktifkan!');
    }
    redirect('Datauser');
  }

  public function ubah_status_nonaktif($kode_user)
  {
    $this->db->query("UPDATE master_user SET `status_aktif`= 0 WHERE kode_user = $kode_user");
    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('success', 'Data Berhasil Dinonaktifkan!');
    }
    redirect('Datauser');
  }
}
