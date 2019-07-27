<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <?= $this->session->flashdata('message'); ?>
        <div class="col-lg-12">
            <table id="cart" class="table table-hover table-condensed">
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($userItems as $i) : ?>
                    <tr>
                        <td><img height="100" width="100" src="<?= base_url('assets/img/products/') . $i['image']; ?>" alt="..." class="img-responsive" /></td>
                        <td><?= $i['name']; ?></td>
                        <td><?= $rupiah = "Rp " . number_format($i['price'], 2, ',', '.');  ?></td>
                        <td class="actions">
                            <a class="btn btn-danger btn-sm" href="<?= base_url('commerce/deleteItems/') . $i['id'] ?>"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td><a href="<?= base_url('commerce') ?>" class="btn-sm btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                    <td colspan="1" class="hidden-xs"></td>
                    <td class="hidden-xs text-center"><strong></strong></td>
                    <td></td>
                </tr>
            </table>
        </div>


    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->