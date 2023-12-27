<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ValidasiTKK extends CI_Controller
{
   function __construct()
   {
      parent::__construct();
      $this->load->model(['M_mahasiswa', 'M_tkkperiode']);
   }

   public function index()
   {
      $status_aktif = 1;
      $data['dataTKKaktif'] = $this->M_tkkperiode->dataTKK_aktif($status_aktif)->result_array();
      $this->template->load('admin/templates/View_template', 'admin/master/View_validasitkk', $data);
   }
}
