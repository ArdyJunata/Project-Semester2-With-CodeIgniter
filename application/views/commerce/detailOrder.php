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
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
                <?php $a = 1;
                $total = 0;
                foreach ($itemOrdered as $i) :
                    $subtotal = $i['price'] * $i['quantity'];
                    $total += $subtotal;
                    ?>
                    <tr>
                        <td><?= $a; ?></td>
                        <td><img height="100" width="100" src="<?= base_url('assets/img/products/') . $i['image']; ?>" alt="..." class="img-responsive" /></td>
                        <td><?= $i['name']; ?></td>
                        <td><?= $rupiah = "Rp " . number_format($i['price'], 2, ',', '.');  ?></td>
                        <td><?= $i['quantity'] ?></td>
                        <td><?= $rupiah = "Rp " . number_format($subtotal, 2, ',', '.'); ?></td>
                    </tr>
                    <?php $a++;
                endforeach; ?>
                <tr>
                    <td colspan="1"></td>
                    <td><a href="<?= base_url('commerce/ordered') ?>" class="btn-sm btn-warning"><i class="fa fa-angle-left"></i> Back</a></td>
                    <td colspan="1"></td>
                    <td>
                        <?php
                        if ($itemOrdered[0]['status'] == 'canceled') { } else if ($itemOrdered[0]['status'] == 'unpaid') {
                            ?>
                            <a href="<?= base_url('commerce/cancelTf/') . $itemOrdered[0]['order_id']; ?>" class="btn-sm btn-danger">Cancel Order</a>
                            <a href="<?= base_url('commerce/confirmTf/') . $itemOrdered[0]['order_id']; ?>" class="btn-sm btn-primary">Confirm Transfer</a>
                        <?php
                        } else if ($itemOrdered[0]['status'] == 'paid') {
                            ?>
                            <a href="<?= base_url('commerce/cancelTf/') . $itemOrdered[0]['order_id']; ?>" class="btn-sm btn-danger">Cancel Order</a>
                        <?php

                        }
                        ?>

                    </td>
                    <td>Total</td>
                    <td><?= $rupiah = "Rp " . number_format($total, 2, ',', '.');  ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->