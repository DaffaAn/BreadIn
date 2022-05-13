<?php
class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        checklogin();
        $this->load->model('Model_User');
    }

    function index()
    {
        $data['user'] = $this->Model_User->getDataUser()->result();
        $this->template->load('template/template', 'user/view_user', $data);
    }

    function inputuser()
    {
        $this->load->view('user/input_user');
    }

    function simpanuser()
    {
        $iduser = $this->input->post('iduser');
        $namalengkap = $this->input->post('namalengkap');
        $nohp = $this->input->post('nohp');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $level = $this->input->post('level');
        $kodecabang = $this->input->post('kodecabang');
        $p = password_hash($password, PASSWORD_DEFAULT);

        $data = array(
            'id_user' => $iduser,
            'nama_lengkap' => $namalengkap,
            'no_hp' => $nohp,
            'username' => $username,
            'password' => $p,
            'level' => $level,
            'kode_cabang' => $kodecabang,
        );

        $simpan = $this->Model_User->insertUser($data);
        if ($simpan == 1) {
            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                    Data user baru berhasil disimpan.
                </div>');
            redirect('user');
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M10 12l4 4m0 -4l-4 4" /></svg>
                    Data user gagal disimpan!
                </div>');
            redirect('user');
        }
    }

    function edituser()
    {
        $iduser = $this->uri->segment(9);
        $data['user'] = $this->Model_User->getUser($iduser)->row_array();
        $this->load->view('user/edit_user', $data);
    }

    function updateuser()
    {
        $iduser = $this->input->post('iduser');
        $namalengkap = $this->input->post('namalengkap');
        $nohp = $this->input->post('nohp');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $level = $this->input->post('level');
        $kodecabang = $this->input->post('kodecabang');
        $p = password_hash($password, PASSWORD_DEFAULT);

        $data = array(
            'nama_lengkap' => $namalengkap,
            'no_hp' => $nohp,
            'username' => $username,
            'password' => $p,
            'level' => $level,
            'kode_cabang' => $kodecabang,
        );

        $simpan = $this->Model_User->updateUser($data, $iduser);
        if ($simpan == 1) {
            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                    Data user baru berhasil disimpan.
                </div>');
            redirect('user');
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M10 12l4 4m0 -4l-4 4" /></svg>
                    Data user gagal disimpan!
                </div>');
            redirect('user');
        }
    }

    function hapususer()
    {
        $iduser = $this->uri->segment(3);
        $hapus = $this->Model_User->deleteUser($iduser);
        if ($hapus == 1) {
            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                    Data user berhasil dihapus.
                </div>');
            redirect('user');
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M10 12l4 4m0 -4l-4 4" /></svg>
                    Data user gagal dihapus!
                </div>');
            redirect('user');
        }
    }
}
