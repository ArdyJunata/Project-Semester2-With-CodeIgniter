<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    private $fb;
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('facebooksdk');
        $this->fb = $this->facebooksdk;
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login';
            $cb = "http://localhost/Cilogin/index.php/auth/callback";
            $url = $this->fb->getLoginUrl($cb);
            $datas = array('url' => $url);
            $this->load->view('templates/login_header', $data);
            $this->load->view('auth/index1', $datas);
            $this->load->view('templates/login_footer');
        } else {
            //validasinya success
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            // jika usernya aktif
            if ($user['is_active'] == 1) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'id' => $user['id'],
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else if ($user['role_id'] == 2) {
                        redirect('user');
                    } else {
                        redirect('site');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email has been not activated!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered!</div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');


        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registration Page';
            $this->load->view('templates/login_header', $data);
            $this->load->view('auth/registration1');
            $this->load->view('templates/login_footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! your account has been created.</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
        redirect('auth');
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }

    public function callback()
    {
        $act = $this->fb->getAccessToken();
        $user = $this->fb->getUserData($act);
        $nama = $user['name'] . " - Facebook";
        $data = [
            'name' => $nama,
            'id' => $user['id']
        ];
        $this->session->set_userdata($data);
        redirect('auth/regisfb');
    }

    public function regisfb()
    {
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('id')])->row_array();
        if ($user) {
            $usercek = $this->db->get_where('user', ['email' => $this->session->userdata('id')])->row_array();
            $data = [
                'id' => $usercek['id'],
                'name' => $usercek['name'],
                'email' => $usercek['email'],
                'role_id' => $usercek['role_id']
            ];
            $this->session->set_userdata($data);
            redirect('user');
        } else {
            $data = [
                'name' => htmlspecialchars($this->session->userdata('name')),
                'email' => htmlspecialchars($this->session->userdata('id')),
                'image' => 'default.jpg',
                'password' => 0,
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()
            ];
            $this->session->set_userdata($data);
            $this->db->insert('user', $data);
            redirect('user');
        }
    }
}
