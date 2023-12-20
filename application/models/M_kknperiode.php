<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_kknperiode extends CI_Model
{

   public function ambil_datakknperiode()
   {
      $this->db->select('*');
      $this->db->From('view_kkn_master_tahap');
      $this->db->order_by('kode_kkn_tahap', 'desc');
      $query = $this->db->get();
      return $query;
   }

   public function ambil_baris_semester($status_aktif)
   {
      $query = $this->db->query("SELECT * FROM master_semester WHERE status_aktif = $status_aktif");
      return $query;
   }

   public function gabungbaris($kode_semester)
   {
      $this->db->where('kode_semester', $kode_semester);
      return $this->db->count_all_results('view_kkn_master_tahap');
   }

   public function tambah_kknperiode($post)
   {
      $params['jenis_kkn'] = $post['jenis_kkn'];
      $params['tahap_ke'] = $post['tahap_ke'];
      $params['kode_semester'] = $post['kode_semester'];
      $params['waktu_pembukaan'] = $post['waktu_pembukaan'];
      $params['waktu_penutupan'] = $post['waktu_penutupan'];
      $params['status_aktif'] = $post['status_aktif'];
      $this->db->insert('kkn_master_tahap', $params);
   }

   public function edit($post)
   {
      $params['jenis_kkn'] = $post['jenis_kkn'];
      $params['tahap_ke'] = $post['tahap_ke'];
      $params['kode_semester'] = $post['kode_semester'];
      $params['waktu_pembukaan'] = $post['waktu_pembukaan'];
      $params['waktu_penutupan'] = $post['waktu_penutupan'];
      $params['status_aktif'] = $post['status_aktif'];
      $this->db->where('kode_kkn_tahap', $post['kode_kkn_tahap']);
      $this->db->update('kkn_master_tahap', $params);
   }
}
