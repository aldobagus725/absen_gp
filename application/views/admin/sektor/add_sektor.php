<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Tambah Sektor</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/sektor') ?>">Sektor</a></li>
					<li class="breadcrumb-item active"><a href="<?= current_url() ?>">Tambah Sektor</a></li>
				</ol>
			</div>
		</div>
	</div>
</section>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header text-center bg-primary text-white">
                        <h4>Tambah Sektor</h4>
                    </div>
                    <form method="POST" action="<?php echo base_url('admin/sektor/set')?>">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Nama Sektor</label>
                                <input type="text" required class="form-control" name="sektor" placeholder="Nama Sektor">
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col text-center">
                                    <input type="submit" name="add_sektor" value="Tambah Sektor" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
