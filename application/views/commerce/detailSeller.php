<?php
$user_id = $this->session->userdata('id');
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $user['name']; ?></h5>
                    <p class="card-text"><?= $user['email']; ?></p>
                    <p class="card-text"><small class="text-muted">Member since <?= date(' d F Y', $user['date_created']); ?></small></p>
                    <i class="fa fa-star" style="color: black" data-id="<?= $user_id; ?>" data-index="0"></i>
                    <i class="fa fa-star" style="color: black" data-id="<?= $user_id; ?>" data-index="1"></i>
                    <i class="fa fa-star" style="color: black" data-id="<?= $user_id; ?>" data-index="2"></i>
                    <i class="fa fa-star" style="color: black" data-id="<?= $user_id; ?>" data-index="3"></i>
                    <i class="fa fa-star" style="color: black" data-id="<?= $user_id; ?>" data-index="4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <form action="<?= base_url('commerce/report/') . $user['id'] ?>" method="post">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Report Description : </label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-danger">Report</button>
        </form>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<script>
    var ratedIndex = -1;
    $(document).ready(function() {

        $.ajax({
            url: 'http://localhost/CILogin/commerce/getRating',
            data: {
                user_id: 3
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                setStars(data.ratedIndex);
            }
        });

        $('.fa-star').on('click', function() {
            ratedIndex = parseInt($(this).data('index'));
            const id = $(this).data('id');
            $.ajax({
                url: 'http://localhost/CILogin/commerce/rating',
                data: {
                    ratedIndex: ratedIndex,
                    user_id: id
                },
                method: 'post',
                success: function(data) {
                    console.log(data);
                }
            });
        });

        $('.fa-star').mouseover(function() {
            resetStarColors();
            var currentIndex = parseInt($(this).data('index'));
            setStars(currentIndex);
        });
        $('.fa-star').mouseleave(function() {
            if (ratedIndex != -1)
                setStars(ratedIndex);
        });
    });

    function setStars(max) {
        for (var i = 0; i <= max; i++)
            $('.fa-star:eq(' + i + ')').css('color',
                '#4E73DF');
    }

    function resetStarColors() {
        $('.fa-star').css('color', 'black');
    }
</script>