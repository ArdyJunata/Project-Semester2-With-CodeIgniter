<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Commerce extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Items';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['items'] = $this->db->get('items')->result_array();
        $data['categories'] = $this->db->get('categories')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('commerce/index.php', $data);
        $this->load->view('templates/footer');
    }

    public function category($id)
    {
        $data['title'] = 'Items';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['items'] = $this->db->get('items')->result_array();
        $data['categories'] = $this->db->get('categories')->result_array();

        $this->load->model('Commerce_model', 'commerce');

        $data['category'] = $this->commerce->getCategoryById($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('commerce/category.php', $data);
        $this->load->view('templates/footer');
    }
}
