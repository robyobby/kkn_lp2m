<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datatkkperiode extends CI_Controller
{
   function __construct()
   {
      parent::__construct();
      // check_not_login();
      $this->load->model(['M_tkkperiode']);
      $this->load->library('form_validation');
   }

   public function index()
   {
      $status_aktif = 1;
      $tkkrow = $this->M_tkkperiode->ambil_datatkkperiode();
      $semesterrow = $this->M_tkkperiode->ambil_baris_semester($status_aktif)->result_array();
      $data = [
         'tkkrow' => $tkkrow,
         'semesterrow' => $semesterrow
      ];
      $this->template->load('admin/templates/View_template', 'admin/master/View_tkkperiode', $data);
   }

   public function ubah_status_aktif($kode_tkk_tahap)
   {
      $query = $this->db->query("SELECT * FROM view_tkk_master_tahap WHERE kode_tkk_tahap = $kode_tkk_tahap");
      $data = $query->row();
      if ($data->status_aktif_semester == 0) {
         $this->session->set_flashdata('warning', 'Maaf untuk mengaktivasi Tahapan, aktifkan dulu Periode Semester !');
      } else {
         $this->db->query("UPDATE tkk_master_tahap SET `status_aktif`= 0");
         $this->db->query("UPDATE tkk_master_tahap SET `status_aktif`= 1 WHERE kode_tkk_tahap = $kode_tkk_tahap");
         if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Berhasil Diaktifkan!');
         }
      }
      redirect('Datatkkperiode');
   }

   public function ubah_status_nonaktif($kode_tkk_tahap)
   {
      $query = $this->db->query("SELECT * FROM view_tkk_master_tahap WHERE kode_tkk_tahap = $kode_tkk_tahap");
      $data = $query->row();
      if ($data->status_aktif_semester == 0) {
         $this->session->set_flashdata('warning', 'Maaf untuk mengaktivasi Tahapan, aktifkan dulu Periode Semester !');
      } else {
         $this->db->query("UPDATE tkk_master_tahap SET `status_aktif`= 0 WHERE kode_tkk_tahap = $kode_tkk_tahap");
         if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Berhasil Dinonaktifkan!');
         }
      }
      redirect('Datatkkperiode');
   }

   public function tambah_tkkperiode()
   {
      $post = $this->input->post(null, TRUE);
      $post['status_aktif'] = 0;
      $this->M_tkkperiode->tambah_tkkperiode($post);
      if ($this->db->affected_rows() > 0) {
         $this->session->set_flashdata('success', 'Data Berhasil Diubah !');
      }
      redirect('Datatkkperiode');
   }

   public function edit_tkkperiode()
   {
      $post = $this->input->post(null, TRUE);
      $this->form_validation->set_rules('tahap_ke', 'Tahap Ke', 'required', array(
         'required' => 'Tahapan tidak boleh kosong'
      ));
      $this->form_validation->set_rules('waktu_pembukaan', 'Waktu Pembukaan', 'required', array(
         'required' => 'Waktu Pembukaan tidak boleh kosong'
      ));
      $this->form_validation->set_rules('waktu_penutupan', 'Waktu Penutupan', 'required', array(
         'required' => 'Waktu Penutupan tidak boleh kosong'
      ));

      // $this->form_validation->set_error_delimiters('<small><span class="help-block">', '</span></small>');

      if ($this->form_validation->run() == FALSE) {
         redirect('Datatkkperiode');
      } else {
         $post = $this->input->post(null, TRUE);
         $this->M_tkkperiode->edit($post);
         if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Berhasil Diubah !');
         }
         redirect('Datatkkperiode');
      }
   }
}
