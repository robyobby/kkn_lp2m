<?php

class Fungsi
{

    protected $ci;

    function __construct()
    {
        $this->ci = &get_instance();
    }

    function user_login()
    {
        $this->ci->load->model('M_user');
        $kode_user = $this->ci->session->userdata('kode_user');
        $user_data = $this->ci->M_user->datauser($kode_user)->row();
        return $user_data;
    }

    function generateRandomString($length = 40) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $randomString = '';
    
        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
    
        return $randomString;
    }
}
