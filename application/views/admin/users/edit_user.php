<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Edit User</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/users') ?>">Users</a></li>
					<li class="breadcrumb-item active"><a href="<?= current_url() ?>">Edit User</a></li>
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
                        <h4>Edit User</h4>
                    </div>
                    <?php foreach ($user as $u){ ?>
                        <form method="POST" action="<?php echo base_url('admin/users/set/').$u->id?>">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" required class="form-control" value="<?= $u->username ?>" name="username" placeholder="username">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Role</label>
                                    <select name="id_role" required class="form-control" aria-label="Default select example">
                                        <option value="">-- Pilih Role --</option>
                                        <?php foreach ($allRoles as $s){ ?>
                                            <option <?=$s->id == $u->id_role ? "selected" : ""?> value="<?= $s->id ?>"><?= $s->role ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col text-center">
                                        <input type="submit" name="edit_sektor" value="Edit Admin" class="btn btn-primary">
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
