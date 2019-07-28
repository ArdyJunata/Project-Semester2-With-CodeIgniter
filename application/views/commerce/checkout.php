<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!--================Order Details Area =================-->
    <section class="order_details section_gap">
        <div class="container">
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


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->