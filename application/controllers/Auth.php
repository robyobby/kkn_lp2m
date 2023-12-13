<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
   public function index()
   {
      $this->template->load('templates/View_template', 'templates/View_dashboard', FALSE);
   }
}
