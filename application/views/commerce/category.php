<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

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
        <?php foreach ($category as $c) :  ?>
            <div class="col-sm-3 mt-3">
                <div class="card" style="width: 15rem;">
                    <img height="300" width="300" src="<?= base_url('assets/img/products/') . $c['image'] ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h6 class="card-title"><?= $c['name'] ?></h6>
                        <p class="card-text"><?= $rupiah = "Rp " . number_format($c['price'], 2, ',', '.');  ?></p>
                        <a href="<?= base_url('commerce/addCart/') . $t['id'] ?>" class="btn btn-primary">Add to cart</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->