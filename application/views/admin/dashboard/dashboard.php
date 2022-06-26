<div class="container-fluid">
    <div class="row" style="padding: 1rem 1rem;">
        <div class="col border-bottom">
            <div class="row">
                <div class="col">
                    <h3><i class='fas fa-home'></i>&nbsp;Dashboard</h3>
                </div>
                <div class="col text-right">
                    <h3>Welcome <?= isset($_SESSION['admin'])?$_SESSION['admin']->username:'' ?>!</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="padding: 1rem 1rem;">
        <div class="col-md-12 mx-auto">
            <div class="row">
                <div class="col-sm-4">
                    <div class="small-box bg-info shadow">
                        <div class="inner">
                            <h3><?= $totalKehadiran ?></h3>
                            <p>Jumlah Hadir Ibadah Hari Ini</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-list"></i>
                        </div>
                        <a href="<?= base_url('admin/absen') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="small-box bg-success shadow">
                        <div class="inner">
                            <h3><?= $total_gp ?></h3>
                            <p>Jumlah Hadir Anggota GP Hari Ini</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="<?= base_url('admin/absen') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="small-box bg-warning shadow">
                        <div class="inner">
                            <h3><?= $total_katekisan ?></h3>
                            <p>Jumlah Hadir Anggota GP - Katekisan Hari Ini</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="<?= base_url('admin/absen') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
