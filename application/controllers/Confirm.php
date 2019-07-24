<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Confirm extends CI_Controller
{
    public function index()
    {
        $datas['title'] = 'Confirm page';
        $data = ['name' => $this->session->userdata('name')];
    }
}
