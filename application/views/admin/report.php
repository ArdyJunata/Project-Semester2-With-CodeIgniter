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
                    <th>Seller</th>
                    <th>Reported by</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Fine</th>
                    <th>Action</th>
                </tr>
                <?php $a = 1;
                $b = 0;
                foreach ($report as $i) : ?>
                    <tr>
                        <td><?= $a ?></td>
                        <td><?= $i['name']; ?></td>
                        <td><?= $reported[$b]['name']; ?></td>
                        <td><?= $i['deskripsi']; ?></td>
                        <td><?= $i['status']; ?></td>
                        <td><?= $i['denda']; ?></td>
                        <td>
                            <?php
                            if ($i['status'] == 'accepted' || $i['status'] == 'deny') {
                                ?>
                                <p>-</p>
                            <?php
                            } elseif ($i['status'] == 'process') {
                                ?>
                                <a href="<?= base_url('admin/deny/') . $i['rid']; ?>" class="btn-sm btn-danger">Deny</a>
                                <!-- <button type="button" class="btn-sm btn-primary" id="denda" data-id="<?= base_url('admin/accept/') . $i['rid']; ?>" data-toggle="modal" data-target="#exampleModal">
                                                                                                                                        Accept
                                                                                                                                    </button> -->
                                <a href="<?= base_url('admin/accept/') . $i['rid']; ?>" class="btn-sm btn-primary">Accept</a>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <?php $a++;
                        $b++;
                    endforeach; ?>
                <tr>

                </tr>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Fine value</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="formDenda">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Denda : </label>
                        <input type="number" class="form-control" id="denda" name="denda">
                    </div>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<script>
    $(document).ready(function() {

        $('#denda').on('click', function() {
            const link = $(this).data('id');
            setAction(link);
        });

        function setAction(link) {
            $('#formDenda').action = link;
        }
    });
</script>