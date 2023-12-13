<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{

  public function ambil_datauser()
  {
    $this->db->select('*');
    $this->db->From('master_user');
    $query = $this->db->get();
    return $query;
  }

  public function edit($post)
  {
    $params['nama'] = $post['nama'];
    $params['email'] = $post['email'];
    $params['password'] = password_hash($post['password'], PASSWORD_BCRYPT);
    $params['status_aktif'] = $post['status_aktif'];
    $this->db->where('kode_user', $post['kode_user']);
    $this->db->update('master_user', $params);
  }

  public function tambah_user($post)
  {
    $params['nama'] = $post['nama'];
    $params['email'] = $post['email'];
    $params['password'] = password_hash($post['password'], PASSWORD_BCRYPT);
    $params['status_aktif'] = $post['status_aktif'];
    $this->db->insert('master_user', $params);
  }
}
