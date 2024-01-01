<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_mahasiswa extends CI_Model
{
   public function ambil_data($nim)
   {
      // $query = $this->db->query("SELECT * FROM master_mahasiswa WHERE nim = $nim");
      $this->db->select('*');
      $this->db->from('master_mahasiswa');
      $this->db->where_in('nim', $nim);
      $query = $this->db->get();
      $result = $query->result();

      if ($result) {
         return $query;
      } else {
         return $query;
      }
   }

   public function ambil_data_TKK($nim)
   {
      // $query = $this->db->query("SELECT * FROM master_mahasiswa WHERE nim = $nim");
      $this->db->select('*');
      $this->db->from('view_tkk_daftar');
      $this->db->where_in('nim', $nim);
      $query = $this->db->get();
      $result = $query->result();

      if ($result) {
         return $query;
      } else {
         return $query;
      }
   }

   public function datadosen($status_aktif)
   {
      $this->db->select('*');
      $this->db->from('master_dosen');
      $this->db->where_in('status_aktif', $status_aktif);
      $query = $this->db->get();
      $result = $query->result();

      if ($result) {
         return $query;
      } else {
         return $query;
      }
   }

   public function tambah_mahasiswa($post)
   {
      $this->db->insert('master_mahasiswa', $post);
   }

   public function tambah_tkkdaftar($post)
   {
      $this->db->insert('tkk_daftar', $post);
   }

   public function edit_mahasiswa($nim, $post)
   {
      $this->db->where('nim', $nim);
      $this->db->update('master_mahasiswa', $post);
   }

   public function update_dataDosen($data, $where) {
      // $data: Array berisi data yang akan di-update
      // $where: Array atau string berisi klausa WHERE

      // Contoh update data
      $this->db->update('tkk_daftar', $data, $where);
   }

   public function cariDosen($nama)
   {
      $this->db->like('nama',$nama,'BOTH');
      $this->db->order_by('nama', 'ASC');
      $this->db->limit(10);
      return $this->db->get('master_dosen')->result();
   }
}
