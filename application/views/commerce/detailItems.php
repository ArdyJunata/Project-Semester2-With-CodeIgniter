<?php
$user_id = $this->session->userdata('id');
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="jumbotron">
        <div class="container">
            <div class="row s_product_inner">
                <div class="col-lg-2"></div>
                <div class="col-lg-4">
                    <img src="<?= base_url('assets/') ?>/img/products/<?= $items['item_image'] ?>" width="300" height="300" alt="">
                </div>
                <div class="col-lg-4">
                    <div class="s_product_text">
                        <h2 style="color: black;"><?= $items['name'] ?></h2>
                        <h4><?= $rupiah = "Rp " . number_format($items['price'], 2, ',', '.'); ?></h4>
                        <ul class="list-unstyled">
                            <li><span>Category</span> : <?= $items['category_name'] ?><span></li>
                            <li><span>Availibility</span> : <?= $items['quantity'] ?><span></li>
                            <li><span>Seller</span> : <?= $items['username'] ?><span></li>
                        </ul>
                        <!-- <span>My Rate : </span>
                        <i class="fa fa-star" style="color: black" data-id="<?= $user_id; ?>" data-index="0"></i>
                        <i class="fa fa-star" style="color: black" data-id="<?= $user_id; ?>" data-index="1"></i>
                        <i class="fa fa-star" style="color: black" data-id="<?= $user_id; ?>" data-index="2"></i>
                        <i class="fa fa-star" style="color: black" data-id="<?= $user_id; ?>" data-index="3"></i>
                        <i class="fa fa-star" style="color: black" data-id="<?= $user_id; ?>" data-index="4"></i> -->
                        <p>Mill Oil is an innovative oil filled radiator with the most modern technology. If you are looking for
                            something that can make your interior look awesome, and at the same time give you the pleasant warm feeling
                            during the winter.</p>
                        <a href="<?= base_url('commerce') ?>" class="btn-sm btn-danger">Back</a>
                        <a href="<?= base_url('commerce/addCart/') . $items['item_id'] ?>" class="btn-sm btn-primary"><i class="fas fa-fw fa-shopping-cart"></i> Add to cart</a>
                    </div>
                </div>
            </div>
        </div>
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
                'red');
    }

    function resetStarColors() {
        $('.fa-star').css('color', 'black');
    }
</script>