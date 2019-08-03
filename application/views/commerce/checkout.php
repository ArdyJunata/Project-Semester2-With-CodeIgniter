<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <!--================Order Details Area =================-->
    <section class="order_details section_gap">
        <div class="container">
            <?= $this->session->flashdata('message'); ?>
            <div class="jumbotron">
                <div class="order_details_table">
                    <h2>Order Details</h2>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Product Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cart as $c) : ?>
                                    <tr>
                                        <td><img height="100" width="100" src="<?= base_url('assets/img/products/') . $c['image']; ?>" alt="..." class="img-responsive" /></td>
                                        <td><?= $c['name']; ?></td>
                                        <td><?= $rupiah = "Rp " . number_format($c['price'], 2, ',', '.');  ?></td>
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
                                    <td colspan="3"></td>
                                    <td>
                                        <p class="lead">Total</p>
                                    </td>
                                    <td>
                                        <p class="lead"><?= $rupiah = "Rp " . number_format($total_cart['total_price'], 2, ',', '.'); ?></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Order Details Area =================-->
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-5">
            <form action="<?= base_url('commerce/payment') ?>" method="post">
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Payment Method</label>
                    <div class="col-sm-7">
                        <select name="payment" id="payment" class="form-control">
                            <option value="">Select Payment</option>
                            <?php foreach ($payment as $p) : ?>
                                <option value="<?= $p['payment_id']; ?>"><?= $p['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-10 mb-2">
                    <a href="<?= base_url('commerce/cart') ?>" class="btn btn-danger"><i class=" fa fa-angle-left"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary">Processed To Payment</button>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->