<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dataperiode extends CI_Controller
{
   function __construct()
   {
      parent::__construct();
      // check_not_login();
      $this->load->model(['M_periode']);
      $this->load->library('form_validation');
   }

   public function index()
   {
      $data['row'] = $this->M_periode->ambil_dataperiode();
      $this->template->load('templates/View_template', 'master/View_periode', $data);
   }

   public function ubah_status_aktif($kode_semester)
   {
      $this->db->query("UPDATE master_semester SET `status_aktif`= 0");
      $this->db->query("UPDATE master_semester SET `status_aktif`= 1 WHERE kode_semester = $kode_semester");
      if ($this->db->affected_rows() > 0) {
         $this->session->set_flashdata('success', 'Data Berhasil Diaktifkan!');
      }
      redirect('Dataperiode');
   }

   public function ubah_status_nonaktif($kode_semester)
   {
      $this->db->query("UPDATE master_semester SET `status_aktif`= 0 WHERE kode_semester = $kode_semester");
      if ($this->db->affected_rows() > 0) {
         $this->session->set_flashdata('success', 'Data Berhasil Dinonaktifkan!');
      }
      redirect('Dataperiode');
   }

   public function tambah_periode()
   {
      $post = $this->input->post(null, TRUE);

      $post = $this->input->post(null, TRUE);
      $post['status_aktif'] = 0;
      $this->M_periode->tambah_periode($post);
      if ($this->db->affected_rows() > 0) {
         $this->session->set_flashdata('success', 'Data Berhasil Diubah !');
      }
      redirect('Dataperiode');
   }

   public function edit_periode()
   {
      $post = $this->input->post(null, TRUE);
      $this->form_validation->set_rules('kode_semester', 'Kode Semester', 'required', array(
         'required' => 'Kode Semester tidak boleh kosong'
      ));
      $this->form_validation->set_rules('semester', 'Semester', 'required', array(
         'required' => 'Semester tidak boleh kosong'
      ));
      $this->form_validation->set_rules('tahun_akademik', 'Tahun Akademik', 'required', array(
         'required' => 'Tahun Akademik tidak boleh kosong'
      ));
      $this->form_validation->set_rules('status_aktif', 'Status Aktif', 'required', array(
         'required' => 'Status Aktif tidak boleh kosong'
      ));
      $this->form_validation->set_rules('kode_semester', 'Kode Semester', 'required', array(
         'required' => 'Kode Semester tidak boleh kosong'
      ));

      // $this->form_validation->set_error_delimiters('<small><span class="help-block">', '</span></small>');

      if ($this->form_validation->run() == FALSE) {
         redirect('Dataperiode');
      } else {
         $post = $this->input->post(null, TRUE);
         $this->M_periode->edit($post);
         if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Berhasil Diubah !');
         }
         redirect('Dataperiode');
      }
   }
}
