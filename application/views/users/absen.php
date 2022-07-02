<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?= base_url()."assets/css/bootstrap.min.css"?>" rel="stylesheet">
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
                <?php 
                    function tanggal_indo($tanggal, $cetak_hari = false)
                    {
                        $hari = array ( 1 =>    'Senin',
                                    'Selasa',
                                    'Rabu',
                                    'Kamis',
                                    'Jumat',
                                    'Sabtu',
                                    'Minggu'
                                );
                                
                        $bulan = array (1 =>   'Januari',
                                    'Februari',
                                    'Maret',
                                    'April',
                                    'Mei',
                                    'Juni',
                                    'Juli',
                                    'Agustus',
                                    'September',
                                    'Oktober',
                                    'November',
                                    'Desember'
                                );
                        $split 	  = explode('-', $tanggal);
                        $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
                        
                        if ($cetak_hari) {
                            $num = date('N', strtotime($tanggal));
                            return $hari[$num] . ', ' . $tgl_indo;
                        }
                        return $tgl_indo;
                    }
                    $day = date("D");
                    $hour = date("H");
                    if ($day != "Fri" || $hour > 22){
                        ?>
                        <div class="alert alert-danger" role="alert">
                           Maaf, absen nya sudah ditutup sampai Jumat minggu depan. Kami tunggu kedatangannya ya!
                        </div>
                        <?php
                    } else if ($day == "Fri" && $hour < 18){
                        ?>
                        <div class="alert alert-danger" role="alert">
                           Absen belum dibuka, tunggu sampai pukul 18.00 ya!
                        </div>
                        <?php
                    } else if  ($day == "Fri" && $hour > 21){
                        ?>
                        <div class="alert alert-danger" role="alert">
                           Absen sudah ditutup ya!
                        </div>
                        <?php
                    }
                     else {
                        ?>
                        <div class="card shadow-sm">
                            <div class="card-header text-center bg-primary text-white">
                                <h4><?php echo tanggal_indo (date("Y-m-d",time()), true); ?></h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="<?php echo base_url('absen/signin')?>">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input type="text" required class="form-control" name="nama_lengkap" placeholder="Nama Lengkap">
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Nomor Telepon</label>
                                                <input type="text" required maxlength="15" class="form-control" name="nomor_telepon" placeholder="082146.........">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Sektor</label>
                                                <select name="sektor" required class="form-select" aria-label="Default select example">
                                                    <option value="">-- Pilih Sektor --</option>
                                                    <?php foreach ($sektor as $s){ ?>
                                                        <option value="<?= $s->id ?>"><?= $s->sektor ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col">
                                            <h5>Apakah anda katekisan?</h5>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="is_katekisan" id="inlineRadio1" value="true">
                                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="is_katekisan" id="inlineRadio2" value="false" checked>
                                                <label class="form-check-label" for="inlineRadio2">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col text-center">
                                                <input type="submit" name="absen" id="tbl_absen" value="Absen Masuk" class="btn btn-primary">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php
                    }
                ?>
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