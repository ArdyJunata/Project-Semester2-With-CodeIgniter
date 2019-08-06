<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Commerce extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    // ITEM
    public function index()
    {
        $data['title'] = 'Buy Product';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id_user = $this->session->userdata('id');


        $data['categories'] = $this->db->get('categories')->result_array();
        $this->load->model('Commerce_model', 'commerce');
        $data['countCart'] = $this->commerce->countCart($this->session->userdata('id'));
        $data['items'] = $this->commerce->getItemsByNotSeller($this->session->userdata('id'));
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('commerce/index.php', $data);
        $this->load->view('templates/footer');
    }

    public function category($id)
    {
        if ($id == 1) {
            $data['title'] = 'Model Kit';
        } else {
            $data['title'] = 'Gundam';
        }
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        $data['categories'] = $this->db->get('categories')->result_array();

        $this->load->model('Commerce_model', 'commerce');
        $data['countCart'] = $this->commerce->countCart($this->session->userdata('id'));
        $data['category'] = $this->commerce->getCategoryById($id, $this->session->userdata('id'));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('commerce/category.php', $data);
        $this->load->view('templates/footer');
    }

    public function detailItems($item_id)
    {
        $data['title'] = 'Detail Item';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Commerce_model', 'commerce');

        $data['categories'] = $this->db->get('categories')->result_array();
        $data['countCart'] = $this->commerce->countCart($this->session->userdata('id'));
        $data['items'] = $this->commerce->getItemsById($item_id, $this->session->userdata('id'));
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('commerce/detailItems.php', $data);
        $this->load->view('templates/footer');
    }
    // END ITEM

    // CART
    public function cart()
    {
        $data['title'] = 'Cart';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['items'] = $this->db->get('items')->result_array();

        $this->load->model('Commerce_model', 'commerce');

        $data['cart'] = $this->commerce->getCartAndItemsbyId($this->session->userdata('id'));

        $data['total_cart'] = $this->commerce->getTotalPrice($this->session->userdata('id'));
        $data['countCart'] = $this->commerce->countCart($this->session->userdata('id'));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('commerce/cart.php', $data);
        $this->load->view('templates/footer');
    }

    public function addCart($id)
    {
        //get item by id
        $user_id = $this->session->userdata('id');
        $data['item'] = $this->db->get_where('items', ['id' => $id])->row_array();
        $this->load->model('Commerce_model', 'commerce');
        if (($this->commerce->checkDuplicateCart($id, $user_id)) > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">The items has been in the cart!</div>');
            redirect('commerce/cart');
        } else {
            $data = [
                'quantity' => 1,
                'total_price' => $data['item']['price'],
                'item_id' => $id,
                'user_id' => $this->session->userdata('id')
            ];

            $this->db->insert('cart', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">add new cart success</div>');
            redirect('commerce/cart');
        }
    }

    public function deleteCart($id)
    {
        $this->db->delete('cart', array('id' => $id));
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">delete cart success</div>');
        redirect('commerce/cart');
    }

    public function updateCart($id)
    {
        $this->load->model('Commerce_model', 'commerce');
        $data['item'] = $this->db->get_where('items', ['id' => $this->input->post('id', true)])->row_array();
        if ($data['item']['quantity'] >= $this->input->post('quantity', true)) {
            if ($this->input->post('quantity', true) == 0) {
                $this->deleteCart($id);
            } else {
                $total = ($this->input->post('quantity', true) * $this->input->post('price', true));
                $this->db->set('quantity', $this->input->post('quantity', true));
                $this->db->set('total_price', $total);
                $this->db->where('id', $id);
                $this->db->update('cart');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">update cart success</div>');
                redirect('commerce/cart');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Out of stock limit!</div>');
            redirect('commerce/cart');
        }
    }
    // END CART

    // WISHLIST
    public function wishlist()
    {
        $data['title'] = 'Wishlist';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['items'] = $this->db->get('items')->result_array();

        $this->load->model('Commerce_model', 'commerce');
        $data['countCart'] = $this->commerce->countCart($this->session->userdata('id'));
        $data['wishlist'] = $this->commerce->getWishlistById($this->session->userdata('id'));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('commerce/wishlist.php', $data);
        $this->load->view('templates/footer');
    }

    public function addWishlist($id)
    {
        //get item by id
        $user_id = $this->session->userdata('id');
        $this->load->model('Commerce_model', 'commerce');
        if (($this->commerce->checkDuplicateWishlist($id, $user_id)) > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">The items has been in the wishlist!</div>');
            redirect('commerce/wishlist');
        } else {
            $data = [
                'item_id' => $id,
                'user_id' => $this->session->userdata('id')
            ];
            $this->db->insert('wishlist', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">add new wishlist success</div>');
            redirect('commerce');
        }
    }

    public function deleteWishlist($id)
    {
        $this->db->delete('wishlist', array('id' => $id));
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">delete cart success</div>');
        redirect('commerce/wishlist');
    }
    //END WISHLIST

    //SELL
    public function sell()
    {
        $data['title'] = 'Sell Product';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['items'] = $this->db->get('items')->result_array();
        $data['category'] = $this->db->get('categories')->result_array();

        $this->load->model('Commerce_model', 'commerce');
        $data['countCart'] = $this->commerce->countCart($this->session->userdata('id'));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('commerce/sell.php', $data);
        $this->load->view('templates/footer');
    }

    public function addItems()
    {
        //cek jika ada gambar yang diubah//
        $upload_image = $_FILES['image']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['upload_path'] = './assets/img/products/';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $new_image = $this->upload->data('file_name');
                $data = [
                    'name' => $this->input->post('name'),
                    'price' => $this->input->post('price'),
                    'quantity' => $this->input->post('quantity'),
                    'category_id' => $this->input->post('category_id'),
                    'user_id' => $this->session->userdata('id'),
                    'image' => $new_image,
                    'date_upload' => time()
                ];
                $this->db->insert('items', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">add new item success</div>');
                redirect('commerce');
            } else {
                echo $this->upload->display_errors();
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">field cannot be null</div>');
            redirect('commerce/sell');
        }
    }
    // END SELL

    // MY ITEMS
    public function userItems()
    {
        $data['title'] = 'My Products';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['items'] = $this->db->get('items')->result_array();

        $this->load->model('Commerce_model', 'commerce');
        $data['countCart'] = $this->commerce->countCart($this->session->userdata('id'));
        $data['userItems'] = $this->commerce->getItemsByUserId($this->session->userdata('id'));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('commerce/userItems.php', $data);
        $this->load->view('templates/footer');
    }

    public function deleteItems($id)
    {
        $this->db->delete('items', array('id' => $id));
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">delete items success</div>');
        redirect('commerce/userItems');
    }
    // END MY ITEMS

    // CONFIRM
    public function checkout()
    {
        $data['title'] = 'Checkout Orders';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Commerce_model', 'commerce');

        $data['cart'] = $this->commerce->getCartAndItemsbyId($this->session->userdata('id'));
        $data['payment'] = $this->db->get('payment')->result_array();

        $data['total_cart'] = $this->commerce->getTotalPrice($this->session->userdata('id'));
        $data['countCart'] = $this->commerce->countCart($this->session->userdata('id'));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('commerce/checkout.php', $data);
        $this->load->view('templates/footer');
    }

    public function payment()
    {

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Commerce_model', 'commerce');
        $data['total_cart'] = $this->commerce->getTotalPrice($this->session->userdata('id'));
        $data['cart'] = $this->commerce->getCartAndItemsbyId($this->session->userdata('id'));
        $data['countCart'] = $this->commerce->countCart($this->session->userdata('id'));

        if ($this->input->post('payment') == 2) {
            $data['title'] = 'Cash On Delivery';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('commerce/cod.php', $data);
            $this->load->view('templates/footer');
        } else {
            $data['title'] = 'Transfer';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('commerce/transfer.php', $data);
            $this->load->view('templates/footer');
        }
    }

    public function tfOrder()
    {
        $this->load->model('Commerce_model', 'commerce');

        $data['total_cart'] = $this->commerce->getTotalPrice($this->session->userdata('id'));
        $data = [
            'payment_id' => $this->input->post('payment'),
            'buyer_id' => $this->session->userdata('id'),
            'total_price' => $data['total_cart']['total_price'],
            'bank' => $this->input->post('bank'),
            'date_order' => date('Y-m-d H:i:s'),
            'due_date' => date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date('m'), date('d') + 1, date('Y'))),
            'status' => 'unpaid'
        ];
        $this->db->insert('orders', $data);
        $order_id = $this->db->insert_id();
        $data['cart'] = $this->commerce->getCartAndItemsbyId($this->session->userdata('id'));
        $isi = array();
        for ($i = 0; $i < count($this->commerce->getCartAndItemsbyId($this->session->userdata('id'))); $i++) {
            $isi[$i] = array(
                'order_id' => $order_id,
                'item_id' => $data['cart'][$i]['id'],
                'quantity' => $data['cart'][$i]['q'],
                'buyer_id' => $this->session->userdata('id')
            );
            $data['items'] = $this->db->get_where('items', ['id' => $data['cart'][$i]['id']])->row_array();
            $sisa = $data['items']['quantity'] - $data['cart'][$i]['q'];
            $this->db->set('quantity', $sisa);
            $this->db->where('id', $data['cart'][$i]['id']);
            $this->db->update('items');
        }
        $this->db->insert_batch('items_ordered', $isi);
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->delete('cart');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">your order is successfull</div>');
        redirect('commerce/ordered');
    }

    public function itemOrder($id)
    {
        $data['title'] = 'Details Order';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Commerce_model', 'commerce');

        $data['cart'] = $this->commerce->getCartAndItemsbyId($this->session->userdata('id'));
        $data['total_cart'] = $this->commerce->getTotalPrice($this->session->userdata('id'));
        $data['countCart'] = $this->commerce->countCart($this->session->userdata('id'));
        $data['itemOrdered'] = $this->commerce->getItemsOrdered($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('commerce/detailOrder.php', $data);
        $this->load->view('templates/footer');
    }

    public function ordered()
    {
        $data['title'] = 'Ordered';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Commerce_model', 'commerce');

        $data['ordered'] = $this->commerce->getOrderandPayment($this->session->userdata('id'));
        $data['cart'] = $this->commerce->getCartAndItemsbyId($this->session->userdata('id'));
        $data['total_cart'] = $this->commerce->getTotalPrice($this->session->userdata('id'));
        $data['countCart'] = $this->commerce->countCart($this->session->userdata('id'));
        $data['itemOrdered'] = $this->commerce->getItemsOrdered($this->session->userdata('id'));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('commerce/ordered.php', $data);
        $this->load->view('templates/footer');
    }

    public function confirmTf($id)
    {
        $this->db->set('status', 'paid');
        $this->db->where('order_id', $id);
        $this->db->update('orders');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Thanks For Transfer!</div>');
        redirect('commerce/ordered');
    }

    public function cancelTf($id)
    {
        $this->db->set('status', 'canceled');
        $this->db->where('order_id', $id);
        $this->db->update('orders');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Your order have been canceled</div>');
        redirect('commerce/ordered');
    }

    public function confirmationCod()
    {
        $data['title'] = 'Confirmation';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Commerce_model', 'commerce');

        $data['ordered'] = $this->commerce->getOrderandPayment($this->session->userdata('id'));
        $data['cart'] = $this->commerce->getCartAndItemsbyId($this->session->userdata('id'));
        $data['total_cart'] = $this->commerce->getTotalPrice($this->session->userdata('id'));
        $data['countCart'] = $this->commerce->countCart($this->session->userdata('id'));
        $data['itemOrdered'] = $this->commerce->getItemsOrdered($this->session->userdata('id'));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('commerce/confirmationCod.php', $data);
        $this->load->view('templates/footer');
    }

    public function codOrder()
    {
        $this->load->model('Commerce_model', 'commerce');

        $data['total_cart'] = $this->commerce->getTotalPrice($this->session->userdata('id'));
        $data = [
            'payment_id' => 2,
            'buyer_id' => $this->session->userdata('id'),
            'total_price' => $data['total_cart']['total_price'],
            'bank' => "-",
            'date_order' => date('Y-m-d H:i:s'),
            'due_date' => date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date('m'), date('d') + 1, date('Y'))),
            'status' => 'unpaid'
        ];
        $this->db->insert('orders', $data);
        $order_id = $this->db->insert_id();
        $data['cart'] = $this->commerce->getCartAndItemsbyId($this->session->userdata('id'));
        $isi = array();
        for ($i = 0; $i < count($this->commerce->getCartAndItemsbyId($this->session->userdata('id'))); $i++) {
            $isi[$i] = array(
                'order_id' => $order_id,
                'item_id' => $data['cart'][$i]['id'],
                'quantity' => $data['cart'][$i]['q'],
                'buyer_id' => $this->session->userdata('id')
            );
            $data['items'] = $this->db->get_where('items', ['id' => $data['cart'][$i]['id']])->row_array();
            $sisa = $data['items']['quantity'] - $data['cart'][$i]['q'];
            $this->db->set('quantity', $sisa);
            $this->db->where('id', $data['cart'][$i]['id']);
            $this->db->update('items');
        }
        $this->db->insert_batch('items_ordered', $isi);
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->delete('cart');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">your order is successfull</div>');
        redirect('commerce/confirmationCod');
    }

    public function refund($id)
    {
        $this->load->model('Commerce_model', 'commerce');
        $data['itemOrdered'] = $this->commerce->getItemsOrdered($id);
        if ($data['itemOrdered'][0]['status'] == 'unpaid') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">you havent pay yet the order!</div>');
            redirect('commerce/ordered');
        } elseif ($data['itemOrdered'][0]['status'] == 'canceled') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">you have cancelled your order</div>');
            redirect('commerce/ordered');
        } elseif ($data['itemOrdered'][0]['status'] == 'paid') {
            $data = [
                'order_id' => $id,
                'buyer_id' => $this->session->userdata('id')
            ];
            $this->db->insert('refund', $data);
            $this->db->set('status', 'refund process');
            $this->db->where('order_id', $id);
            $this->db->update('orders');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">your request being processed</div>');
            redirect('commerce/ordered');
        } elseif ($data['itemOrdered'][0]['status'] == 'refund process') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">your refund request being processed</div>');
            redirect('commerce/ordered');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">something wrong!</div>');
            redirect('commerce/ordered');
        }
    }

    public function rating()
    {
        if ($this->db->get_where('rating', array('user_id' => $_POST['user_id']))->num_rows() > 0) {
            $this->db->set('ratedIndex', $_POST['ratedIndex']);
            $this->db->where('user_id', $_POST['user_id']);
            $this->db->update('rating');
        } else {
            $data = array(
                'ratedIndex' => $_POST['ratedIndex'],
                'user_id' => $_POST['user_id']
            );
            $this->db->insert('rating', $data);
        }
    }

    public function getRating()
    {
        $data['ranked'] = $this->db->get_where('rating', array('user_id' => $_POST['user_id']))->row_array();
        echo json_encode($data['ranked']);
    }

    public function detailSeller($user_id)
    {
        $data['title'] = 'Seller Profile';
        $data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();
        $this->load->model('Commerce_model', 'commerce');
        $data['countCart'] = $this->commerce->countCart($this->session->userdata('id'));
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('commerce/detailSeller', $data);
        $this->load->view('templates/footer');
    }

    public function report($seller_id)
    {
        $data = [
            'seller_id' => $seller_id,
            'buyer_id' => $this->session->userdata('id'),
            'deskripsi' => $this->input->post('deskripsi'),
            'status' => 'process'
        ];
        $this->db->insert('report', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">your report being processed</div>');
        redirect('commerce/index');
    }
}
