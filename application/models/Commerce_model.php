<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Commerce_model extends CI_Model
{
    public function getCategoryById($id)
    {
        $query = "SELECT `items`.`quantity` `quantity`, `items`.`id` `id`, `items`.`name` `name`, `items`.`price` `price`,                          `items`.`image` `image` FROM `items`, `categories`
                    WHERE `categories`.`id` = `items`.`category_id` and `categories`.`id` = $id";
        return $this->db->query($query)->result_array();
    }

    public function getCartAndItemsbyId($id)
    {
        $query = "SELECT *,(items.price*cart.quantity) as total_harga, items.price as price, cart.id as id_cart, cart.quantity as q from cart, items where cart.item_id = items.id and cart.user_id = $id";
        return $this->db->query($query)->result_array();
    }

    public function getSumCart($id)
    {
        $query = "SELECT *,(items.price*cart.quantity) as total_harga, items.price as price, cart.id as id_cart, cart.quantity as q from cart, items where cart.item_id = items.id and cart.id = $id";
        return $this->db->query($query)->row_array();
    }

    public function getTotalPrice($id)
    {
        $query = $this->db->query("SELECT sum(`total_price`) as `total_price` from `cart` where `user_id` = $id");
        $row = $query->row_array();
        return $row;
    }

    public function checkDuplicateCart($id, $user_id)
    {
        $query = $this->db->query("SELECT * from `cart` where `user_id` = $user_id and `item_id` = $id");
        $row = $query->num_rows();
        return $row;
    }

    public function countCart($id)
    {
        $query = $this->db->query("SELECT count(*) as jumlah from `cart` where `user_id` = $id");
        $row = $query->row_array();
        return $row;
    }

    public function getWishlistById($id)
    {
        $query = "SELECT *,w.id as id_w, i.id as id_item, i.name as name, i.price as price, i.image as image FROM wishlist w, items i WHERE w.item_id = i.id AND w.user_id = $id";
        return $this->db->query($query)->result_array();
    }

    public function checkDuplicateWishlist($id, $user_id)
    {
        $query = $this->db->query("SELECT * from `wishlist` where `user_id` = $user_id and `item_id` = $id");
        $row = $query->num_rows();
        return $row;
    }

    public function getItemsByUserId($id)
    {
        $query = "SELECT * FROM items WHERE user_id = $id";
        return $this->db->query($query)->result_array();
    }
}
