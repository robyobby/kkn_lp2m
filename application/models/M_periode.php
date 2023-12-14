<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_periode extends CI_Model
{

   public function ambil_dataperiode()
   {
      $this->db->select('*');
      $this->db->From('master_semester');
      $query = $this->db->get();
      return $query;
   }

   public function tambah_periode($post)
   {
      $params['semester_akademik'] = $post['semester_akademik'];
      $params['semester'] = $post['semester'];
      $params['tahun_akademik'] = $post['tahun_akademik'];
      $params['status_aktif'] = $post['status_aktif'];
      $this->db->insert('master_semester', $params);
   }

   public function edit($post)
   {
      $params['semester_akademik'] = $post['semester_akademik'];
      $params['semester'] = $post['semester'];
      $params['tahun_akademik'] = $post['tahun_akademik'];
      $params['status_aktif'] = $post['status_aktif'];
      $this->db->where('kode_semester', $post['kode_semester']);
      $this->db->update('master_semester', $params);
   }
}
