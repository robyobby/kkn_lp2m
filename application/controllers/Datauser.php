<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datauser extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    check_not_login();
    $this->load->model(['M_user']);
    $this->load->library('form_validation');
  }

   public function index()
   {
      // $data['row'] = $this->M_user->ambil_datauser();
      // $this->template->load('templates/View_template', 'user/View_user', $data);
      $this->template->load('templates/View_template', 'user/View_user', TRUE);
   }
}
