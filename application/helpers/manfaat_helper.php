<?php

function check_already_login()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('email');
    if ($user_session) {
        redirect('Dashboard');
    }
}

function check_not_login()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('email');
    if (!$user_session) {
        redirect('Auth');
    }
}

function indo_date($date)
{
    $d = substr($date, 8, 2);
    $m = substr($date, 5, 2);
    $y = substr($date, 0, 4);
    return $d . '-' . $m . '-' . $y;
}

function indo_date_2($date)
{
    $d = substr($date, 8, 2);
    $m = substr($date, 5, 2);
    $y = substr($date, 0, 4);
    return $d . '/' . $m . '/' . $y;
}

function tahun($date)
{
    $y = substr($date, 0, 4);
    return $y;
}
