<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Users Role</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
					<li class="breadcrumb-item active"><a href="<?= current_url() ?>">Users Role</a></li>
				</ol>
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
								<h3 class="card-title">Users Role</h3>
							</div>
							<div class="col text-right">
								<a class="btn btn-primary" href="<?php echo base_url('admin/role/addForm') ?>" >
									+ Tambah Role
								</a>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered table-striped" id="table">
								<thead>
									<tr>
										<th class="text-center">ID</th>
                                        <th class="text-center">Role</th>
										<th class="text-center">Created At</th>
										<th class="text-center">Updated At</th>
										<th class="text-center">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php if ($allRoles) {
										foreach ($allRoles as $row) { ?>
											<tr>
												<td class="text-center"><?= $row->id; ?></td>
                                                <td class="text-center"><?= $row->role; ?></td>
												<td class="text-center"><?= $row->created_at; ?></td>
												<td class="text-center"><?= $row->updated_at; ?></td>
												<td class="text-center">
													<div class="btn-group" role="group">
														<a href="<?= base_url('admin/role/edit/'.$row->id)?>"
															class="btn btn-warning">
															<i class='fas fa-pen'></i>
														</a>
														<a href="<?= base_url('admin/role/delete/'.$row->id)?>"
															class="btn btn-danger">
															<i class='fas fa-trash-alt'></i>
														</a>
													</div>
												</td>
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