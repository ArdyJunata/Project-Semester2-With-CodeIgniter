<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= $this->session->flashdata('message'); ?>
    <div class="row">

        <div class="col-lg-6">
            <div class="alert alert-info" role="alert">
                Shipping Address
            </div>
            <form action="<?= base_url('user/editLocation') ?>" method="post">
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Country</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" value="<?= $user['country']; ?>" id="country" name="country">
                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Province</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" value="<?= $user['province']; ?>" id="province" name="province">
                        <?= form_error('address1', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">City</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" value="<?= $user['city']; ?>" id="city" name="city">
                        <?= form_error('address1', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Addess</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" value="<?= $user['address1']; ?>" id="address1" name="address1">
                        <?= form_error('address2', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Postal Code</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" value="<?= $user['postal_code']; ?>" id="postal" name="postal">
                        <?= form_error('postal', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
                <div class="form-group row justify-content-end">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary" name="Edit" id="Edit">Edit</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-6">
            <div class="alert alert-info" role="alert">
                Transfer Method
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
            <form action="<?= base_url('commerce/tfOrder') ?>" method="post">
                <input type="hidden" name="payment" id="payment" value="1">
                <div class="form-group row">
                    <label for="bank" class="col-sm-2 col-form-label">Bank</label>
                    <div class="col-sm-7">
                        <select name="bank" id="bank" class="form-control">
                            <option value="">Select Bank</option>
                            <option value="BRI">BRI (Bank Rakyat Indonesia) </option>
                            <option value="BCA">BCA (Bank Central Indonesia)</option>
                            <option value="BNI">BNI (Bank Negeri Indonesia)</option>
                            <option value="MANDIRI">Bank Mandiri</option>
                            <option value="BSM">Bank Syariah Mandiri</option>
                            <option value="BUKOPIN">Bank Bukopin</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <button type="submit" class="btn btn-primary" name="save" id="save">Processed Payment</button>
                </div>
            </form>

        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->