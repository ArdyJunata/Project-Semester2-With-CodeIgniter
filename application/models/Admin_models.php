<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Admin_models extends CI_Model
{
    public function getReport()
    {
        $query = "SELECT *, r.id as rid  FROM report r, user u WHERE r.seller_id = u.id";
        return $this->db->query($query)->result_array();
    }
    public function getReported()
    {
        $query = "SELECT *FROM report r, user u WHERE r.buyer_id = u.id";
        return $this->db->query($query)->result_array();
    }
}
