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
        $this->ci->load->model('user_m');
        $kode_user = $this->ci->session->userdata('kode_user');
        $user_data = $this->ci->user_m->get($kode_user)->row();
        return $user_data;
    }
}
