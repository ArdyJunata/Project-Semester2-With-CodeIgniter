	<div class="limiter">
	    <div class="container-login100">
	        <div class="wrap-login100">
	            <div class="login100-pic js-tilt" data-tilt>
	                <img src="<?= base_url('assets/login/') ?>images/img-01.png" alt="IMG">
	            </div>

	            <form action="<?= base_url('auth'); ?>" method="post" class="login100-form validate-form">
	                <span class="login100-form-title">
	                    Member Login
	                </span>
	                <?= $this->session->flashdata('message') ?>
	                <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
	                    <input class="input100" type="text" name="email" id="email" placeholder="Email">
	                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
	                    <span class="focus-input100"></span>
	                    <span class="symbol-input100">
	                        <i class="fa fa-envelope" aria-hidden="true"></i>
	                    </span>
	                </div>

	                <div class="wrap-input100 validate-input" data-validate="Password is required">
	                    <input class="input100" type="password" name="password" id="password" placeholder="Password">
	                    <?= form_error('password', '<small class="text-danger pl-3">', '</small>') ?>
	                    <span class="focus-input100"></span>
	                    <span class="symbol-input100">
	                        <i class="fa fa-lock" aria-hidden="true"></i>
	                    </span>
	                </div>

	                <div class="container-login100-form-btn">
	                    <button type="submit" class="login100-form-btn" style="background-color: #4C71DD;">
	                        Login
	                    </button>
	                </div>

	                <div class="text-center p-t-12">
	                    <a class="txt2" href="<?= $url; ?>">Login With Facebook</a>
	                </div>

	                <div class="text-center p-t-136">
	                    <a class="txt2" href="<?= base_url('auth/registration') ?>">
	                        Create your Account
	                        <i class="fas fa-chevron-right m-l-5" aria-hidden="true"></i>
	                    </a>
	                </div>
	            </form>
	        </div>
	    </div>
	</div>