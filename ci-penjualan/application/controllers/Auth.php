<?php
class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Auth');
    }

    function login()
    {
        checklog();
        $this->load->view('auth/login');
    }

    function ceklogin()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $login = $this->Model_Auth->getLogin($username);
        $ceklogin = $login->num_rows();
        $datalogin = $login->row_array();
        $data = array(
            //ditambahin fungsi isset karena pake PHP diatas versi 5, biar gak muncul exception kalo salah masukin username atau password
            'id_user' => $datalogin['id_user'] = isset($datalogin['id_user']) ? $datalogin['id_user'] : '',
            'nama_lengkap' => $datalogin['nama_lengkap'] = isset($datalogin['nama_lengkap']) ? $datalogin['nama_lengkap'] : '',
            'no_hp' => $datalogin['no_hp'] = isset($datalogin['no_hp']) ? $datalogin['no_hp'] : '',
            'username' => $datalogin['username'] = isset($datalogin['username']) ? $datalogin['username'] : '',
            'password' => $datalogin['password'] = isset($datalogin['password']) ? $datalogin['password'] : '',
            'level' => $datalogin['level'] = isset($datalogin['level']) ? $datalogin['level'] : '',
            'kode_cabang' => $datalogin['kode_cabang'] = isset($datalogin['kode_cabang']) ? $datalogin['kode_cabang'] : ''
        );

        //buat ngeverify password yang udah dihash (dicocokin)
        $this->session->set_userdata($data);
        if ($ceklogin > 0) {
            $hasil = $login->row();
            if (password_verify($password, $hasil->password)) {
                redirect('dashboard');
            }
        } else {
            $this->session->set_flashdata('msg', '
            <div class="alert alert-warning" role="alert">
                <!-- SVG icon code with class="mr-1" -->
                Username / password anda salah atau anda tidak memiliki akun.
            </div>
            ');
            redirect('auth/login', 'refresh');
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
