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
}
