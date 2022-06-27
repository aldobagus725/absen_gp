<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Absen Hari Ini</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
					<li class="breadcrumb-item active"><a href="<?= current_url() ?>">Absen</a></li>
				</ol>
			</div>
		</div>
	</div>
</section>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header bg-white text-dark">
						<div class="row align-items-center">
							<div class="col">
                                <form method="POST" action="<?= base_url('admin/absen/custom_date')?>">
                                    <h4>Lihat Absen</h4>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label>Dari Tanggal</label>
                                                <input type="date" required class="form-control" name="fromDate">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label>Sampai Tanggal</label>
                                                <input type="date" required class="form-control" name="toDate">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <input type="submit" class="btn btn-primary" value="Cari Data" name="find_absen">
                                </form>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered table-striped" id="table">
								<thead>
									<tr>
										<th class="text-center">Nama Lengkap</th>
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
                    <div class="card-footer">
                        <div class="row">
                            <div class="col">
                                <p>Tanggal Absen : <?= $tanggalAbsen?></p>
                                <p>Jumlah Hadir : <?= $totalKehadiran?></p>
                                <p>Jumlah Anggota GP : <?= $total_gp?></p>
                                <p>Jumlah Katekisan : <?= $total_katekisan?></p>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
</section>