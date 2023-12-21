<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    check_not_login();
  }

  public function index()
  {
    $this->template->load('admin/templates/View_template', 'admin/templates/View_dashboard', TRUE);
  }
}
