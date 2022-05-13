<?php
class Model_User extends CI_Model{
    function getDataUser(){
        return $this->db->get('users');
    }

    function insertUser($data){
        $simpan = $this->db->insert('users', $data);
        if($simpan){
            return 1;
        }
        else{
            return 0;
        }
    }

    function getUser($iduser){
        return $this->db->get_where('users', array('id_user' => $iduser));
    }

    function updateUser($data, $iduser){
        $simpan=$this->db->update('users', $data, array('id_user' => $iduser));
        if($simpan){
            return 1;
        }
        else{
            return 0;
        }
    }

    function deleteUser($iduser){
        $hapus = $this->db->delete('users', array('id_user' => $iduser));
        if($hapus){
            return 1;
        }
        else{
            return 0;
        }
    }
}