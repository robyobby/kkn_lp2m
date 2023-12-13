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
}
