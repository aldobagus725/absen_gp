<style>
	.list-group-item{
		background-color: transparent!important;
		color: black!important;
		border-color: transparent!important;
	}
</style>
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Absen Hari Ini</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
					<li class="breadcrumb-item active"><a href="<?= current_url() ?>">Absen Hari Ini</a></li>
				</ol>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="card shadow-sm">
					<div class="card-header bg-primary text-dark">
						<h5>Kehadiran Berdasarkan Status</h5>
					</div>
					<div class="card-body">
						<ul class="list-group">
							<li class="list-group-item d-flex justify-content-between align-items-center">
								Jumlah Hadir
								<span class="badge badge-primary badge-pill"><?= $totalKehadiran?> orang</span>
							</li>
							<li class="list-group-item d-flex justify-content-between align-items-center">
								Jumlah Anggota GP
								<span class="badge badge-primary badge-pill"><?= $total_gp?> orang</span>
							</li>
							<li class="list-group-item d-flex justify-content-between align-items-center">
								Jumlah Katekisan
								<span class="badge badge-primary badge-pill"><?= $total_katekisan?> orang</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="card shadow-sm">
					<div class="card-header bg-info text-dark">
						<h5>Kehadiran Berdasarkan Sektor</h5>
					</div>
					<div class="card-body">
						<ul class="list-group">
							<?php if($hadirSektor){
								foreach ($hadirSektor as $hs){?>
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<?=$hs->sektor?>
										<span class="badge badge-primary badge-pill"><?=$hs->total_hadir?></span>
									</li>
								<?php }
							} else { ?>
							<li class="list-group-item d-flex justify-content-between align-items-center">
								N/A
								<span class="badge badge-primary badge-pill">N/A</span>
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
                <?php if ($this->session->flashdata('success')){ ?>
                    <br>
                    <div class="row">
                        <div class="col">
                            <div class="alert alert-success" role="alert">
                                <?php echo $this->session->flashdata('success'); ?>
                            </div>
                        </div>
                    </div>
                <?php } else if($this->session->flashdata('warning')){ ?>
                    <br>
                    <div class="row">
                        <div class="col">
                            <div class="alert alert-warning" role="alert">
                                <?php echo $this->session->flashdata('warning'); ?>
                            </div>
                        </div>
                    </div>
                <?php } else if($this->session->flashdata('danger')){ ?>
                    <br>
                    <div class="row">
                        <div class="col">
                            <div class="alert alert-danger" role="alert">
                                <?php echo $this->session->flashdata('danger'); ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
				<div class="card">
					<div class="card-header bg-dark">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="card-title">Absen Hari Ini</h3>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered table-striped" id="table">
								<thead>
									<tr>
										<th class="text-center">Nama Lengkap</th>
										<th class="text-center">Sektor</th>
										<th class="text-center">Nomor Telepon</th>
                                        <th class="text-center">Status</th>
										<th class="text-center">Absen Jam</th>
									</tr>
								</thead>
								<tbody>
									<?php if ($absens) {
										foreach ($absens as $row) { ?>
											<tr>
												<td class="text-center"><?= $row->nama_lengkap; ?></td>
												<td class="text-center"><?= $row->sektor; ?></td>
												<td class="text-center"><?= $row->nomor_telepon; ?></td>
                                                <td class="text-center"><?= $row->is_katekisan == "true" ? "Katekisan" : "Anggota GP"; ?></td>
												<td class="text-center"><?= $row->created_at; ?></td>
											</tr>
										<?php  }
									} else { ?> <div class="alert alert-info">Tidak Ada Data</div> <?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>