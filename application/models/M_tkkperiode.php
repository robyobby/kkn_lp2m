<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_tkkperiode extends CI_Model
{

   public function ambil_datatkkperiode()
   {
      $this->db->select('*');
      $this->db->From('view_tkk_master_tahap');
      $query = $this->db->get();
      return $query;
   }

   public function ambil_baris_datatkkperiode($kode_tkk_tahap)
   {
      // $query = $this->db->get('view_tkk_master_tahap');
      $query = $this->db->query("SELECT * FROM view_tkk_master_tahap WHERE kode_tkk_tahap = $kode_tkk_tahap");
      return $query;
   }

   public function gabungbaris($kode_semester)
   {
      $this->db->where('kode_semester', $kode_semester);
      return $this->db->count_all_results('view_tkk_master_tahap');
   }

   public function tambah_tkkperiode($post)
   {
      $params['kode_tkk_tahap'] = $post['kode_tkk_tahap'];
      $params['kode_semester'] = $post['kode_semester'];
      $params['waktu_pembukaan'] = $post['waktu_pembukaan'];
      $params['waktu_penutupan'] = $post['waktu_penutupan'];
      $params['status_aktif'] = $post['status_aktif'];
      $this->db->insert('tkk_master_tahap', $params);
   }
}
