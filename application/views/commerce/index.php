<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= $this->session->flashdata('message'); ?>
    <div class="row">

        <div class="col-sm-3">
            <ul class="list-group">
                <li class="list-group-item active">Categories</li>
                <a href="<?= base_url('commerce') ?>" class="list-group-item list-group-item-action">All Items</a>
                <?php foreach ($categories as $c) : ?>
                    <a href="<?= base_url('commerce/category/') . $c['id'] ?>" class="list-group-item list-group-item-action"><?= $c['name'] ?></a>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php foreach ($items as $t) :  ?>
            <div class="col-sm-3 mt-3">
                <div class="card" style="width: 17rem;">
                    <img height="300" width="300" src="<?= base_url('assets/img/products/') . $t['image'] ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h6 class="card-title"><?= $t['name'] ?></h6>
                        <p class="card-text"><?= $rupiah = "Rp " . number_format($t['price'], 2, ',', '.'); ?></p>
                        <p class="card-text"><i class="fas fa-layer-group"></i> Stock <?= $t['quantity'] ?></p>
                        <?php
                        if (($this->commerce->checkDuplicateWishlist($t['id'], $this->session->userdata('id'))) > 0) {
                            ?>
                            <a href="" class="btn-sm btn-danger mb-2" onclick="alert('item has been in the wishlist');"><i class="far fa-heart"></i></a>
                        <?php
                        } else { ?>
                            <a href="<?= base_url('commerce/addWishlist/') . $t['id'] ?>" class="btn-sm btn-dark mb-2"><i class="far fa-heart"></i></a>
                        <?php
                        }
                        ?>
                        <a href="" class="btn-sm btn-dark mb-2"><i class="fas fa-info-circle"></i> Detail</a>
                        <a href="<?= base_url('commerce/addCart/') . $t['id'] ?>" class="btn-sm btn-dark"><i class="fas fa-fw fa-shopping-cart"></i> Add to cart</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->