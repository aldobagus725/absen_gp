<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Edit Role</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/users_role') ?>">Users Role</a></li>
					<li class="breadcrumb-item active"><a href="<?= current_url() ?>">Edit Role</a></li>
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
                        <h4>Edit Role</h4>
                    </div>
                    <?php foreach ($role as $r){ ?>
                        <form method="POST" action="<?php echo base_url('admin/role/set/').$r->id?>">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Role</label>
                                    <input type="text" required class="form-control" value="<?= $r->role ?>" name="role" placeholder="Nama Role">
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col text-center">
                                        <input type="submit" name="edit_role" value="Edit Role" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
