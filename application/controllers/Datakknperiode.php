<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datakknperiode extends CI_Controller
{
   function __construct()
   {
      parent::__construct();
      // check_not_login();
      $this->load->model(['M_kknperiode']);
      $this->load->library('form_validation');
   }

   public function index()
   {
      $status_aktif = 1;
      $kknrow = $this->M_kknperiode->ambil_datakknperiode();
      $semesterrow = $this->M_kknperiode->ambil_baris_semester($status_aktif)->result_array();
      $data = [
         'kknrow' => $kknrow,
         'semesterrow' => $semesterrow
      ];
      $this->template->load('templates/View_template', 'master/View_kknperiode', $data);
   }

   public function ubah_status_aktif($kode_kkn_tahap)
   {
      $query = $this->db->query("SELECT * FROM view_kkn_master_tahap WHERE kode_kkn_tahap = $kode_kkn_tahap");
      $data = $query->row();
      if ($data->status_aktif_semester == 0) {
         $this->session->set_flashdata('warning', 'Maaf untuk mengaktivasi Tahapan, aktifkan dulu Periode Semester !');
      } else {
         $this->db->query("UPDATE kkn_master_tahap SET `status_aktif`= 0");
         $this->db->query("UPDATE kkn_master_tahap SET `status_aktif`= 1 WHERE kode_kkn_tahap = $kode_kkn_tahap");
         if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Berhasil Diaktifkan!');
         }
      }
      redirect('Datakknperiode');
   }

   public function ubah_status_nonaktif($kode_kkn_tahap)
   {
      $query = $this->db->query("SELECT * FROM view_kkn_master_tahap WHERE kode_kkn_tahap = $kode_kkn_tahap");
      $data = $query->row();
      if ($data->status_aktif_semester == 0) {
         $this->session->set_flashdata('warning', 'Maaf untuk mengaktivasi Tahapan, aktifkan dulu Periode Semester !');
      } else {
         $this->db->query("UPDATE kkn_master_tahap SET `status_aktif`= 0 WHERE kode_kkn_tahap = $kode_kkn_tahap");
         if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Berhasil Dinonaktifkan!');
         }
      }
      redirect('Datakknperiode');
   }

   public function tambah_kknperiode()
   {
      $post = $this->input->post(null, TRUE);

      $post = $this->input->post(null, TRUE);
      $post['status_aktif'] = 0;
      $this->M_kknperiode->tambah_kknperiode($post);
      if ($this->db->affected_rows() > 0) {
         $this->session->set_flashdata('success', 'Data Berhasil Diubah !');
      }
      redirect('Datakknperiode');
   }

   public function edit_kknperiode()
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
         redirect('Datakknperiode');
      } else {
         $post = $this->input->post(null, TRUE);
         $this->M_kknperiode->edit($post);
         if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Berhasil Diubah !');
         }
         redirect('Datakknperiode');
      }
   }
}
