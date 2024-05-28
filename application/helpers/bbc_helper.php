<?php

function cek_login()
{
    $ci = get_instance();
    if (!$ci->session->userdata('login')) {
        redirect('auth');
    } else {

        $id_role = $ci->session->userdata('id_role');

        $menu = $ci->db->get_where('menu', ['url' => $ci->uri->segment(1) ])->row_array();

        if (!$menu) {
            echo "menu tidak ada didatabase";
            die;
            show_404();
        }

        $userAccess = $ci->db->get_where('role_access_menu', [
            'id_role' => $id_role,
            'id_menu' => $menu['id_menu']
        ])->row_array();

        if (!$userAccess) {
            echo "403 unauthorized";
            die;
            show_404();
        }
    }
}


function check_menu($id_role, $id_menu)
{
    $ci = get_instance();

    $ci->db->where('id_role', $id_role);
    $ci->db->where('id_menu', $id_menu);
    $result = $ci->db->get('role_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

function check_submenu($id_role, $id_submenu)
{
    $ci = get_instance();

    $ci->db->where('id_role', $id_role);
    $ci->db->where('id_submenu', $id_submenu);
    $result = $ci->db->get('role_access_submenu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}