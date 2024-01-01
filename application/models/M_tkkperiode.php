<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_tkkperiode extends CI_Model
{

   public function ambil_datatkkperiode()
   {
      $this->db->select('*');
      $this->db->From('view_tkk_master_tahap');
      $this->db->order_by('kode_tkk_tahap', 'desc');
      $query = $this->db->get();
      return $query;
   }

   public function ambil_baris_semester($status_aktif)
   {
      $query = $this->db->query("SELECT * FROM master_semester WHERE status_aktif = $status_aktif");
      return $query;
   }

   public function ambil_baris_tkk_tahap($status_aktif)
   {
      $query = $this->db->query("SELECT * FROM view_tkk_master_tahap WHERE status_aktif_tahapan_tkk = $status_aktif");
      return $query;
   }

   public function ambil_daftartkk($nim)
   {
      // $query = $this->db->query("SELECT * FROM view_tkk_daftar WHERE nim = $nim AND status_aktif_tkk_daftar = 1");
      // return $query;

      $this->db->select('*');
      $this->db->from('view_tkk_daftar');
      $this->db->where_in('nim', $nim);
      $this->db->where('status_aktif_tkk_daftar', 1);
      $query = $this->db->get();
      $result = $query->result();

      if ($result) {
         return $query;
      } else {
         return $query;
      }
   }

   public function gabungbaris($kode_semester)
   {
      $this->db->where('kode_semester', $kode_semester);
      return $this->db->count_all_results('view_tkk_master_tahap');
   }

   public function tambah_tkkperiode($post)
   {
      $params['kode_semester'] = $post['kode_semester'];
      $params['tahap_ke'] = $post['tahap_ke'];
      $params['waktu_pembukaan'] = $post['waktu_pembukaan'];
      $params['waktu_penutupan'] = $post['waktu_penutupan'];
      $params['status_aktif'] = $post['status_aktif'];
      $this->db->insert('tkk_master_tahap', $params);
   }

   public function edit($post)
   {
      $params['kode_semester'] = $post['kode_semester'];
      $params['tahap_ke'] = $post['tahap_ke'];
      $params['waktu_pembukaan'] = $post['waktu_pembukaan'];
      $params['waktu_penutupan'] = $post['waktu_penutupan'];
      $params['status_aktif'] = $post['status_aktif'];
      $this->db->where('kode_tkk_tahap', $post['kode_tkk_tahap']);
      $this->db->update('tkk_master_tahap', $params);
   }

   public function dataTKK_aktif($kode_tkk_tahap)
   {
      $this->db->select('*');
      $this->db->from('view_tkk_daftar');
      $this->db->where('kode_tkk_tahap', $kode_tkk_tahap);
      $query = $this->db->get();
      $result = $query->result();

      if ($result) {
         return $query;
      } else {
         return $query;
      }
   }

   public function dataTKK_aktifDosen($kode_tkk_tahap)
   {
      $this->db->select('*');
      $this->db->from('view_tkk_daftar_dosen');
      $this->db->where('kode_tkk_tahap', $kode_tkk_tahap);
      $query = $this->db->get();
      $result = $query->result();

      if ($result) {
         return $query;
      } else {
         return $query;
      }
   }

   public function dataTKK_filter($kode_tkk_tahap)
   {
      $this->db->select('*');
      $this->db->from('view_tkk_daftar');
      $this->db->where('kode_tkk_tahap', $kode_tkk_tahap);
      $this->db->where('kode_dosen IS NOT NULL');
      $query = $this->db->get();
      $result = $query->result();

      if ($result) {
         return $query;
      } else {
         return $query;
      }
   }

   public function dataTKK_filterNULL($kode_tkk_tahap)
   {
      $this->db->select('*');
      $this->db->from('view_tkk_daftar');
      $this->db->where('kode_tkk_tahap', $kode_tkk_tahap);
      $this->db->where('kode_dosen IS NULL');
      $query = $this->db->get();
      $result = $query->result();

      if ($result) {
         return $query;
      } else {
         return $query;
      }
   }
}
