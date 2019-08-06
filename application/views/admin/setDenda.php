<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <form action="<?= base_url('admin/setDenda/') . $id; ?>" method="post" id="formDenda">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Denda : </label>
                <input type="number" class="form-control" id="denda" name="denda">
            </div>
            <button type="submit" class="btn btn-primary">Confirm</button>
        </form>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->