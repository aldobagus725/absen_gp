

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
                <h2>Absen Ibadah GP GPIB Kasih Karunia Badung - Bali</h2>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <?php if ($this->session->flashdata('success')){ ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php } else if($this->session->flashdata('warning')){ ?>
                    <div class="alert alert-warning" role="alert">
                        <?php echo $this->session->flashdata('warning'); ?>
                    </div>
                <?php } else if($this->session->flashdata('danger')){ ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $this->session->flashdata('danger'); ?>
                    </div>
                <?php } else { ?>
                    <h4>There's nothing here! Get Back!</h4>
                    <a href="<?php echo base_url(); ?>" class="btn btn-danger"> < Back</a>
                <?php } ?>
                <a href="<?php echo base_url(); ?>" class="btn btn-danger"> < Back</a>
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