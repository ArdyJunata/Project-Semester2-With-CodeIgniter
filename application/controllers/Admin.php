<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Commerce_model', 'commerce');
        $data['countCart'] = $this->commerce->countCart($this->session->userdata('id'));
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function userActive()
    {
        $data['title'] = 'User Acive';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Commerce_model', 'commerce');
        $data['countCart'] = $this->commerce->countCart($this->session->userdata('id'));
        $data['menu'] = $this->db->get('user')->result_array();
        $data['role'] = $this->db->get('user_role')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/userActive', $data);
        $this->load->view('templates/footer');
    }

    public function deleteUser($id)
    {
        $this->db->delete('user', array('id' => $id));
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Delete success</div>');
        redirect('admin/userActive');
    }

    public function adduser()
    {
        $data = [
            'name' => htmlspecialchars($this->input->post('name', true)),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'image' => 'default.jpg',
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role_id' => htmlspecialchars($this->input->post('user_role', true)),
            'is_active' => 1,
            'date_created' => time()
        ];

        $this->db->insert('user', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! your account has been created.</div>');
        redirect('admin/userActive');
    }

    public function report()
    {
        $data['title'] = 'Report List';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Admin_models', 'admin');
        $data['report'] = $this->admin->getReport();
        $data['reported'] = $this->admin->getReported();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/report', $data);
        $this->load->view('templates/footer');
    }

    public function accept($id)
    {
        $this->db->set('status', 'accepted');
        $this->db->where('id', $id);
        $this->db->update('report');
        redirect("admin/setDenda/" . $id);
    }

    public function deny($id)
    {
        $this->db->set('status', 'deny');
        $this->db->where('id', $id);
        $this->db->update('report');
        redirect("admin/report");
    }

    public function setDenda($id)
    {
        if ($this->input->post('denda')) {
            $this->db->set('denda', $this->input->post('denda'));
            $this->db->where('id', $id);
            $this->db->update('report');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Fine have been updated!</div>');
            redirect('admin/report');
        } else {
            $data['title'] = 'Set Denda';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['id'] = $id;
            $this->load->model('Admin_models', 'admin');
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/setDenda', $data);
            $this->load->view('templates/footer');
        }
    }
}
