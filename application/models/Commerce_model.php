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

    public function getCartAndItemsbyId($id)
    {
        $query = "SELECT * from cart, items where cart.item_id = items.id and cart.user_id = $id";
        return $this->db->query($query)->result_array();
    }

    public function getTotalPrice($id)
    {
        $query = $this->db->query("SELECT sum(`total_price`) as `total_price`, `user_id` from `cart` where `user_id` = $id");
        $row = $query->row();
        return $row;
    }
}
