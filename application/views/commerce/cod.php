<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= $this->session->flashdata('message'); ?>
    <div class="row">

        <div class="col-lg-6">
            <div class="alert alert-info" role="alert">
                COD Location
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
                    <label for="name" class="col-sm-3 col-form-label">Address 1</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" value="<?= $user['address1']; ?>" id="address1" name="address1">
                        <?= form_error('address1', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Addess 2</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" value="<?= $user['address2']; ?>" id="address2" name="address2">
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
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->