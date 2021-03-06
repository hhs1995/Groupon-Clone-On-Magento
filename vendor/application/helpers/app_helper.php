<?php  if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('is_admin')) {
    function is_admin()
    {
        $CI =& get_instance();
        $user = $CI->session->userdata('username');
        $row = $CI->Users_model->getMemberByUsername($user);
        if (($row['username'] == $user) && ($row['active'] == 1) && ($row['is_admin'] == 1)) {
            return $row;
        }
        return false;
    }
}
if (!function_exists('is_auth')) {
    function is_auth()
    {
        $CI =& get_instance();
        $user = $CI->session->userdata('username');
        $id = $CI->session->userdata('id');
        $row = $CI->Users_model->getMemberByUsername($user);
        if (($id == $row['id']) && ($row['username'] == $user) && ($row['active'] == 1)) {
            return $row;
        } else {
            //$CI->session->destroy();
        }
        return false;
    }
}
if (!function_exists('getUID')) {
    function getUID()
    {
        $CI =& get_instance();
        return $id = $CI->session->userdata('id');
    }
}
if (!function_exists('getPath')) {

    function getPath($path = '', $depth = 0)
    {
        $arr = explode('/', $path);
        $max = count($arr) - 1 - $depth;

        for ($i = 0; $i <= $max; $i++) {
            $nArr[] = $arr[$i];
        }
        return join('/', $nArr);
    }
}

if (!function_exists('initMage')) {

    function initMage($code = '')
    {
        $path = getPath(dirname(__FILE__), 3);
        if (file_exists($path . '/app/Mage.php')) {
            include_once($path . '/app/Mage.php');
            Mage::app($code);
        }
    }
}

if (!function_exists('getDateGMT')) {

    function getDateGMT($date = '',$format = 'Y-m-d h:i:s A')
    {
        return date($format,strtotime("+4 hours",strtotime($date)));
    }
}