<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SISTEM INFORMASI PEMESANAN LAPANGAN FUTSAL</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/AdminLTE.min.css'); ?>">

    <link rel="icon" href="<?php echo base_url('assets/images/home.png'); ?>" type="image/png">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-box-body">
            <div class="text-center">
                <img src="<?php echo base_url('assets/images/home.png'); ?>" alt="Image" width="150">
            </div>
            <br>
            <div class="text-center">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
            <form action="<?php echo site_url('login/cek'); ?>" method="post">
                <div class="form-group has-feedback">
                    <input type="text" name="username" class="form-control" placeholder="Username" value="<?= set_value('username') ?>">
                    <span class="fa fa-user form-control-feedback"></span>
                    <span class="text-danger"><?php echo form_error('username'); ?></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Password" value="<?= set_value('password') ?>">
                    <span class="fa fa-lock form-control-feedback"></span>
                    <span class="text-danger"><?php echo form_error('password'); ?></span>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" name="login" class="btn btn-success btn-block btn-flat">Login</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <script src="<?php echo base_url('assets/js/jQuery-2.1.4.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
</body>

</html>