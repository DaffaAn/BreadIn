<?php
class Model_Auth extends CI_Model
{
    function getLogin($username)
    {
        return $this->db->get_where('users', array('username'=>$username));
    }
}