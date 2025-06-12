<?= $this->extend('Home/Layouts/template-login'); ?>

<?= $this->section('content'); ?>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <a href="<?= site_url('/') ?>" class="back-to-home-btn">
                    <i class="fa fa-home"></i>
                    Home
                </a>
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="<?= base_url('home/assets/images/img-01.png') ?>" alt="IMG">
                </div>

                <form class="login100-form validate-form" action="<?= base_url('auth/processlogin') ?>" method="post">
                    <span class="login100-form-title">
                        Login Form
                    </span>

                    <div class="wrap-input100 validate-input" data-validate="Username is required">
                        <input class="input100" type="text" name="username" placeholder="Username">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div>

                    <div class="text-center p-t-136">
                        <a class="txt2" href="<?= base_url('auth/register') ?>">
                            Create your Account
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?= $this->endSection() ?>