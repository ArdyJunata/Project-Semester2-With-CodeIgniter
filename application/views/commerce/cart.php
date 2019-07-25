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
                    <th>Quantity</th>
                    <th>Price</th>
                    <th class="text-center">Subtotal</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($cart as $c) : ?>
                    <tr>
                        <td><img height="100" width="100" src="<?= base_url('assets/img/products/') . $c['image'] ?>" alt="..." class="img-responsive" /></td>
                        <td><?= $c['name']; ?></td>
                        <td><?= $rupiah = "Rp " . number_format($c['price'], 2, ',', '.');  ?></td>
                        <td width="6%">
                            <input type="number" class="form-control" value="<?= $c['q']; ?>">
                        </td>
                        <td class="text-center"><?= $rupiah = "Rp " . number_format($c['total_price'], 2, ',', '.');  ?></td>
                        <td class="actions">
                            <button class="btn btn-info btn-sm"><i class="fas fa-sync-alt"></i></button>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <tr>
                    <td><a href="#" class="btn-sm btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                    <td colspan="3" class="hidden-xs"></td>
                    <td class="hidden-xs text-center"><strong><?= $rupiah = "Rp " . number_format($total['total_price'], 2, ',', '.'); ?></strong></td>
                    <td><a href="#" class="btn-sm btn-success">Checkout <i class=" fa fa-angle-right"></i></a></td>
                </tr>
            </table>
        </div>


    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->