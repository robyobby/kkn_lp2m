<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datadosen extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    // check_not_login();
    $this->load->model(['M_dosen']);
    $this->load->library('form_validation');
  }

  public function index()
  {
    $data['row'] = $this->M_dosen->ambil_datadosen()->result();
    $this->template->load('admin/templates/View_template', 'admin/master/View_dosen', $data);
  }

  public function hapus($kode_dosen)
  {
    $this->M_dosen->hapus($kode_dosen);

    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('success', 'Data Berhasil Dihapus !');
    }
    redirect('Datadosen');
  }

  public function edit_dosen()
  {
    $post = $this->input->post(null, TRUE);

    $this->form_validation->set_rules('nama', 'Nama', 'required', array(
      'required' => 'Nama tidak boleh kosong'
    ));
    $this->form_validation->set_error_delimiters('<small><span class="help-block">', '</span></small>');

    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('warning', 'Ada Kesalahan Dalam Mengisi !');
      redirect('Datadosen');
    } else {
      $post = $this->input->post(null, TRUE);
      $this->M_dosen->edit($post);
      if ($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('success', 'Data Berhasil Diubah !');
      }
      redirect('Datadosen');
    }
  }

  public function tambah_dosen()
  {
    $post = $this->input->post(null, TRUE);

    $this->form_validation->set_rules('nama', 'Nama', 'required', array(
      'required' => 'Nama tidak boleh kosong'
    ));

    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('warning', 'Ada Kesalahan Dalam Mengisi !');
      redirect('Datadosen');
    } else {
      $post = $this->input->post(null, TRUE);
      $post['status_aktif'] = 1;
      $this->M_dosen->tambah_dosen($post);
      if ($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('success', 'Data Berhasil Diubah !');
      }
      redirect('Datadosen');
    }
  }
}
