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
      $data['row'] = $this->M_tkkperiode->ambil_datatkkperiode();
      $this->template->load('templates/View_template', 'master/View_tkkperiode', $data);
   }

   public function ubah_status_aktif($kode_tkk_tahap)
   {
      $this->db->query("UPDATE tkk_master_tahap SET `status_aktif`= 0");
      $this->db->query("UPDATE tkk_master_tahap SET `status_aktif`= 1 WHERE kode_tkk_tahap = $kode_tkk_tahap");
      if ($this->db->affected_rows() > 0) {
         $this->session->set_flashdata('success', 'Data Berhasil Diaktifkan!');
      }
      redirect('Datatkkperiode');
   }

   public function ubah_status_nonaktif($kode_tkk_tahap)
   {
      $this->db->query("UPDATE master_semester SET `status_aktif`= 0 WHERE kode_tkk_tahap = $kode_tkk_tahap");
      if ($this->db->affected_rows() > 0) {
         $this->session->set_flashdata('success', 'Data Berhasil Dinonaktifkan!');
      }
      redirect('Datatkkperiode');
   }

   public function tambah_periode()
   {
      $post = $this->input->post(null, TRUE);

         $post = $this->input->post(null, TRUE);
         $post['status_aktif'] = 0;
         $this->M_tkkperiode->tambah_tkkperiode($post);
         if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Berhasil Diubah !');
         }
         redirect('Datatkkperiode');
      
      }

}
