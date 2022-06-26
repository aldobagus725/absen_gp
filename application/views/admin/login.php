<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?= base_url()."assets/css/bootstrap.min.css"?>" rel="stylesheet">
    <link href="<?= base_url()."assets/css/animate.css"?>" rel="stylesheet">
    <link rel="shortcut icon" href="<?= base_url('assets/img/gpib_new.png') ?>" />
    <title>Absen GP</title>
  </head>
  <body>
    <div class="container mt-2">
        <div class="row" style="padding:2rem 2rem">
            <div class="col-md-2 mx-auto text-center">
                <img src="<?= base_url('assets/img/GP.png') ?>" style="width:60%">
            </div>
        </div>
        <div class="row">
            <div class="col text-center">
                <h2>Admin Absen Ibadah GP GPIB Kasih Karunia Badung - Bali</h2>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card shadow-sm">
                    <div class="card-header text-center bg-primary text-white">
                        <h4>Login Admin</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" required class="form-control" name="username" placeholder="Username">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" required class="form-control" name="password" placeholder="082146.........">
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col text-center">
                                        <input type="submit" name="login" id="lognBtn" value="Login" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php if($this->session->flashdata('error')){ ?>
                            <br>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $this->session->flashdata('error'); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="padding:4rem 2rem;">
            <div class="col text-center">
                <h6 style="color:gray;">&copy; Copyright 2022 KOMISI INFORKOM GPIB KASIH KARUNIA BADUNG - BALI</h6>
            </div>
        </div>
    </div>
    <script src="<?= base_url()."assets/jss/bootstrap.bundle.min.js"?>" ></script>
  </body>
</html>