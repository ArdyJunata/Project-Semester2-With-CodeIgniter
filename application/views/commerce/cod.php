<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= $this->session->flashdata('message'); ?>
    <div class="row">

        <div class="col-lg-6">
            <div class="alert alert-info" role="alert">
                You can only COD with the seller location area
            </div>
            <p>The Seller location area is :</p>
            <form action="<?= base_url('commerce/codOrder') ?>" method="post">
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Country</label>
                    <div class="col-sm-7">
                        <input type="disabled" class="form-control" value="<?= $user['country']; ?>" id="country" name="country" readonly>
                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Province</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" value="<?= $user['province']; ?>" id="province" name="province" readonly>
                        <?= form_error('address1', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">City</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" value="<?= $user['city']; ?>" id="city" name="city" readonly>
                        <?= form_error('address1', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Addess</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" value="<?= $user['address1']; ?>" id="address1" name="address1" readonly>
                        <?= form_error('address2', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
                <div class="form-group row justify-content-end">
                    <div class="col-sm-9">
                        <a href="<?= base_url('commerce/cart') ?>" class="btn btn-danger">cancel</a>
                        <button type="submit" class="btn btn-primary" name="accept" id="accept">accept</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-6">
            <div class="alert alert-info" role="alert">
                Detail
            </div>
            <div class="alert alert-secondary" role="alert">
                Your Order
                <hr>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cart as $c) : ?>
                                <tr>

                                    <td><?= $c['name']; ?></td>
                                    <td width="6%">
                                        <?= $c['q']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $rupiah = "Rp " . number_format($c['total_price'], 2, ',', '.');
                                        echo ($rupiah);
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="1"></td>
                                <td>Shipping</td>
                                <td>Free</td>
                            </tr>
                            <tr>
                                <td colspan="1"></td>
                                <td>
                                    <p>Total</p>
                                </td>
                                <td>
                                    <p><?= $rupiah = "Rp " . number_format($total_cart['total_price'], 2, ',', '.'); ?></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->