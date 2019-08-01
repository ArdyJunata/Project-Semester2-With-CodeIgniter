<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?> Status</h1>
    <div class="row">
        <?= $this->session->flashdata('message'); ?>
        <div class="col-lg-12">
            <table id="cart" class="table table-hover table-condensed">
                <tr>
                    <th>#</th>
                    <th>Payment</th>
                    <th>Bank</th>
                    <th>Date</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php $a = 1;
                foreach ($ordered as $i) : ?>

                    <tr>
                        <td><?= $a ?></td>
                        <td><?= $i['name']; ?></td>
                        <td><?= $i['bank'];  ?></td>
                        <td><?= $i['date_order'] ?></td>
                        <td><?= $i['due_date'] ?></td>
                        <td><?= $i['status'] ?></td>
                        <td><a href="<?= base_url('commerce/itemOrder/') . $i['order_id'] ?>" class="btn-sm btn-primary">detail</a></td>
                    </tr>

                    <?php $a++;
                endforeach; ?>
            </table>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->