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
