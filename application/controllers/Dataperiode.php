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
      $this->template->load('templates/View_template', 'periode/View_periode', $data);
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
}
