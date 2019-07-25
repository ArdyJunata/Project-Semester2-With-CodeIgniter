<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Commerce_model extends CI_Model
{
    public function getCategoryById($id)
    {
        $query = "SELECT `items`.`id` `id`, `items`.`name` `name`, `items`.`price` `price`, `items`.`image` `image` FROM `items`, `categories`
                    WHERE `categories`.`id` = `items`.`category_id` and `categories`.`id` = $id";
        return $this->db->query($query)->result_array();
    }
}
