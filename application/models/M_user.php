<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{

  public function ambil_datauser()
  {
    $this->db->select ('*');
    $this->db->From ('master_user');
    $this->db->where('status',1);
    $query = $this->db->get();
    return $query;
  }

}