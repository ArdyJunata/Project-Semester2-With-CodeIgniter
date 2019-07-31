<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Commerce_model', 'commerce');
        $data['countCart'] = $this->commerce->countCart($this->session->userdata('id'));
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Commerce_model', 'commerce');
        $data['countCart'] = $this->commerce->countCart($this->session->userdata('id'));
        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            //cek jika ada gambar yang diubah//
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
            redirect('user');
        }
    }

    public function editLocation()
    {
        $this->form_validation->set_rules('country', 'country', 'required|trim');
        $this->form_validation->set_rules('address1', 'address1', 'required|trim');
        $this->form_validation->set_rules('address2', 'address2', 'required|trim');
        $this->form_validation->set_rules('postal', 'postal', 'required|trim');

        if ($this->form_validation->run() == false) {
            redirect('commerce/payment');
        } else {
            $country = $this->input->post('country');
            $address1 = $this->input->post('address1');
            $address2 = $this->input->post('address2');
            $postal_code = $this->input->post('postal');

            $this->db->set('country', $country);
            $this->db->set('address1', $address1);
            $this->db->set('address2', $address2);
            $this->db->set('postal_code', $postal_code);
            $this->db->where('id', $this->session->userdata('id'));
            $this->db->update('user');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your address has been updated!</div>');
            redirect('commerce/payment');
        }
    }
}
