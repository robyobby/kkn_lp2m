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

   public function editSertifikat($kode_tkk_daftar, $data)
   {
      $this->db->where('kode_tkk_daftar', $kode_tkk_daftar);
      $this->db->update('tkk_daftar', $data);
   }

   public function dataTKK_aktif($kode_tkk_tahap)
   {
      $this->db->select('*');
      $this->db->from('view_tkk_daftar');
      $this->db->where('kode_tkk_tahap', $kode_tkk_tahap);
      $this->db->order_by('nama', 'ASC');
      $query = $this->db->get();
      $result = $query->result();

      if ($result) {
         return $query;
      } else {
         return $query;
      }
   }

   public function dataTKK_lulus($kode_tkk_tahap, $status_kelulusan)
   {
      $this->db->select('*');
      $this->db->from('view_tkk_daftar');
      $this->db->where('kode_tkk_tahap', $kode_tkk_tahap);
      $this->db->where('status_lulus', $status_kelulusan);
      $this->db->where('no_sertifikat IS NULL');
      $this->db->order_by('nama', 'ASC');
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
      $this->db->order_by('nama_dosen', 'ASC');
      $query = $this->db->get();
      $result = $query->result();

      if ($result) {
         return $query;
      } else {
         return $query;
      }
   }

   public function dataTKK_filter($kode_tkk_tahap, $status)
   {
      $this->db->select('*');
      $this->db->from('view_tkk_daftar');
      $this->db->where('kode_tkk_tahap', $kode_tkk_tahap);
      $this->db->where('kode_dosen IS NOT NULL');
      $this->db->where('status_lulus', $status);
      $this->db->order_by('nama', 'ASC');
      $query = $this->db->get();
      $result = $query->result();

      if ($result) {
         return $query;
      } else {
         return $query;
      }
   }

   public function dataTKK_filterNULL($kode_tkk_tahap, $status)
   {
      $this->db->select('*');
      $this->db->from('view_tkk_daftar');
      $this->db->where('kode_tkk_tahap', $kode_tkk_tahap);
      $this->db->where('kode_dosen IS NULL');
      $this->db->where('status_lulus', $status);
      $this->db->order_by('nama', 'ASC');
      $query = $this->db->get();
      $result = $query->result();

      if ($result) {
         return $query;
      } else {
         return $query;
      }
   }

   public function cekKelulusan($kode_tkk_tahap)
   {
      $query = $this->db->query("SELECT * FROM view_tkk_daftar WHERE kode_tkk_tahap = $kode_tkk_tahap AND status_lulus = 'tg'");
      return $query;
   }

   public function dataMahasiswaLulus($kode_tkk_tahap)
   {
      $this->db->where('kode_tkk_tahap', $kode_tkk_tahap);
      $this->db->where('status_lulus', 'l');
      return $this->db->count_all_results('view_tkk_daftar');
   }

   public function dataMahasiswaTidakLulus($kode_tkk_tahap)
   {
      $this->db->where('kode_tkk_tahap', $kode_tkk_tahap);
      $this->db->where('status_lulus', 'tl');
      return $this->db->count_all_results('view_tkk_daftar');
   }

   public function BlankoNilaiDosen($kode_tkk_tahap, $kode_dosen)
   {
      $query = $this->db->query("SELECT * FROM view_tkk_daftar_dosen WHERE kode_tkk_tahap = $kode_tkk_tahap AND kode_dosen = $kode_dosen");
      return $query;
   }

   public function ambil_baris_kode_dosen($kode_tkk_tahap)
   {
      $query = $this->db->query("SELECT DISTINCT kode_dosen FROM view_tkk_daftar_dosen WHERE kode_tkk_tahap = $kode_tkk_tahap");
      return $query;
   }
}
