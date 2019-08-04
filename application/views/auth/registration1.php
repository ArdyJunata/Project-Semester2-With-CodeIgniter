<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="<?= base_url('assets/login/') ?>images/img-01.png" alt="IMG">
            </div>

            <form action="<?= base_url('auth/registration'); ?>" method="post" class="login100-form validate-form">
                <span class="login100-form-title">
                    Member Login
                </span>
                <?= $this->session->flashdata('message') ?>
                <div class="wrap-input100 validate-input" data-validate="Username is required">
                    <input class="input100" type="text" name="name" id="name" placeholder="Full Name">
                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>') ?>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fas fa-user" aria-hidden="true"> </i>
                    </span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                    <input class="input100" type="text" name="email" id="email" placeholder="Email">
                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="password1" id="password1" placeholder="Password 1">
                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>') ?>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="password2" id="password2" placeholder="Password 2">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn" style="background-color: #4C71DD;">
                        Register
                    </button>
                </div>


                <div class="text-center p-t-136">
                    <a class="txt2" href="<?= base_url('auth') ?>">
                        Click here to login
                        <i class="fas fa-chevron-right m-l-5" aria-hidden="true"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>