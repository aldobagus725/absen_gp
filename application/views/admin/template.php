<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Absen GP</title>
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/adminlte/plugins/fontawesome-free/css/all.min.css">
		<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/adminlte/dist/css/adminlte.min.css">
		<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
		<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
		<link rel="stylesheet" type="text/css" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/adminlte/plugins/select2/css/select2.min.css">
		<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
		<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
		<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/adminlte/plugins/toastr/toastr.min.css">
		<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/adminlte/plugins/summernote/summernote-bs4.min.css">
		<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/')?>animate.css"/>
		<link rel="shortcut icon" href="<?= base_url('assets/img/gpib_new.png') ?>" />
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<script src="<?= base_url() ?>assets/adminlte/plugins/jquery-validation/jquery.validate.min.js"></script>
		<script src="<?= base_url() ?>assets/adminlte/plugins/jquery-validation/additional-methods.min.js"></script>
	</head>
	<body class="hold-transition sidebar-mini sidebar-dark-primary">
		<div class="wrapper">
			<!-- Navbar -->
			<nav class="main-header navbar navbar-expand navbar-white navbar-light shadow-sm">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
					</li>
				</ul>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="far fa-user"></i> <?= $_SESSION['admin']->username; ?>
						</a>
						<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
							<div class="dropdown-divider"></div>
							<a href="<?= base_url('admin/logout') ?>" class="dropdown-item dropdown-footer">Logout</a>
						</div>
					</li>
				</ul>
			</nav>
			<!-- Main Sidebar Container -->
			<aside class="main-sidebar elevation-2">
				<!-- Brand Logo -->
				<a href="<?= base_url('admin') ?>" class="brand-link">
					<img src="<?= base_url('assets/img/gpib_new.png') ?>" alt="GP" class="brand-image" style="opacity: .8">
					<span class="brand-text font-weight-bold">GP KKBB Dashboard</span>
				</a>
				<!-- Sidebar -->
				<div class="sidebar sidebar-fixed">
					<div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
						<div class="image">
							<img src="<?= base_url('assets/img/'); ?>avatar.png" class="img-circle elevation-2" alt="User Image">
						</div>
						<div class="info">
							<a href="<?= base_url('admin') ?>" class="d-block">
								<?= isset($_SESSION['admin']) ? $_SESSION['admin']->username . ' <br> Role: ' . $_SESSION['admin']->role : '' ?>
							</a>
						</div>
					</div>
					<!-- Sidebar Menu -->
					<nav class="mt-2">
						<ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
							<li class="nav-item">
								<a href="<?= base_url('admin') ?>" class="nav-link <?= (current_url() == base_url('admin/dashboard')) || (current_url() == base_url('admin')) ? 'active' : '' ?>">
									<i class="nav-icon fas fa-tachometer-alt"></i>
									<p>DASHBOARD</p>
								</a>
							</li>
							<?php $absen = array(base_url('admin/absen/hari_ini'), base_url('admin/absen/custom_date'));?>
							<li class="nav-item 
								<?php if (in_array(current_url(), $absen)) {
									echo "menu-open";
								} ?>">
								<a href="#" class="nav-link 
								<?php if (in_array(current_url(), $absen)) {
									echo "active";
								} ?>">
									<i class="nav-icon fas fa-user-friends"></i>
									<p>ABSEN<i class="right fas fa-angle-left"></i></p>
								</a>
								<ul class="nav nav-treeview">
									<!-- MENUS -->
									<li class="nav-item">
										<a href="<?= base_url('admin/absen/hari_ini') ?>" class="nav-link <?= (current_url() == base_url('admin/absen/hari_ini')) ? 'active' : '' ?>">
											<i class="nav-icon fas fa-user-friends"></i>
											<p>Absen Hari Ini</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url("admin/absen/custom_date") ?>" class="nav-link <?= (current_url() == base_url('admin/absen/custom_date')) ? 'active' : '' ?>">
											<i class="nav-icon fas fa-file-alt"></i>
											<p>Laporan Absen</p>
										</a>
									</li>
								</ul>
							</li>
							<?php if($_SESSION['admin']->role == "superadmin"){ ?>
								<li class="nav-item">
									<a href="<?= base_url('admin/sektor') ?>" class="nav-link <?= (current_url() == base_url('admin/sektor')) || (current_url() == base_url('admin/sektor')) ? 'active' : '' ?>">
										<i class="nav-icon fas fa-map-marker "></i>
										<p>SEKTOR</p>
									</a>
								</li>
							<?php } ?>

							<!-- ========== SETTINGS ========== -->
							<?php
							// Links for users
							$settings = array(
								base_url('admin/role'),base_url('admin/users')
							);
							?>
							<?php if ($_SESSION['admin']->role == "superadmin") { ?>
								<li class="nav-item 
								<?php if (in_array(current_url(), $settings)) {
									echo "menu-open";
								} ?>">
									<a href="#" class="nav-link 
									<?php if (in_array(current_url(), $settings)) {
										echo "active";
									} ?>">
										<i class="nav-icon fas fa-cog"></i>
										<p>SETTINGS<i class="right fas fa-angle-left"></i></p>
									</a>
									<ul class="nav nav-treeview">
										<!-- MENUS -->
										<?php if ($_SESSION['admin']->role == "superadmin") { ?>
											<li class="nav-item">
												<a href="<?= base_url('admin/users') ?>" class="nav-link <?= (current_url() == base_url('admin/users')) ? 'active' : '' ?>">
													<i class="nav-icon fas fa-user-cog"></i>
													<p>Admins</p>
												</a>
											</li>
										<?php } else {
										} ?>
										<?php if ($_SESSION['admin']->role == "superadmin") { ?>
											<li class="nav-item">
												<a href="<?= base_url("admin/role") ?>" class="nav-link <?= (current_url() == base_url('admin/role')) ? 'active' : '' ?>">
													<i class="nav-icon fas fa-id-card-alt"></i>
													<p>Role User</p>
												</a>
											</li>
										<?php } else {
										} ?>
									</ul>
								</li>
							<?php } ?>
						</ul>
					</nav>
				</div>
			</aside>
			<div class="content-wrapper">
				<?= $content; ?>
			</div>
			<!-- Main Footer -->
			<footer class="main-footer">
				<div class="float-right d-none d-sm-inline">
					God Bless!
				</div>
				<strong>Copyright &copy; KOMISI INFORKOM GPIB KASIH KARUNIA BADUNG - BALI 2022</a>.</strong> All rights reserved.
			</footer>
		</div>
	</body>
	<script>
		var base_url = '<?php echo base_url() ?>';
	</script>
	<script src="<?= base_url() ?>assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url() ?>assets/adminlte/dist/js/adminlte.min.js"></script>
	<script src="<?= base_url() ?>assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url() ?>assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?= base_url() ?>assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script src="<?= base_url() ?>assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
	<script src="<?= base_url() ?>assets/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
	<script src="<?= base_url() ?>assets/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
	<script src="<?= base_url() ?>assets/adminlte/plugins/jszip/jszip.min.js"></script>
	<script src="<?= base_url() ?>assets/adminlte/plugins/pdfmake/pdfmake.min.js"></script>
	<script src="<?= base_url() ?>assets/adminlte/plugins/pdfmake/vfs_fonts.js"></script>
	<script src="<?= base_url() ?>assets/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
	<script src="<?= base_url() ?>assets/adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
	<script src="<?= base_url() ?>assets/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
	<!-- Select2 -->
	<script src="<?= base_url() ?>assets/adminlte/plugins/select2/js/select2.full.min.js"></script>
	<!-- SweetAlert2 -->
	<script src="<?= base_url() ?>assets/adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>
	<!-- Toastr -->
	<script src="<?= base_url() ?>assets/adminlte/plugins/toastr/toastr.min.js"></script>
	<!-- Summernote -->
	<script src="<?= base_url() ?>assets/adminlte/plugins/summernote/summernote-bs4.min.js"></script>
	<script src="<?=base_url('assets/wow/')?>wow.js"></script>
	<script>
		// new WOW().init();
		//also at the window load event
		$(window).on('load', function(){
			new WOW().init(); 
		});
	</script>
	<script type="text/javascript">
		$(function() {
			$('#table').DataTable({
				dom: 'Bfrtip',
				buttons: [
					'copy', 'excel', 'pdf', 'csv'
				]
			});
		});

		$(function() {
			var Toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000
			});
			<?php if ($this->session->flashdata('flash') == 'success') { ?>
				var title = '<?php echo $this->session->flashdata('message') ?>';
				Toast.fire({
					icon: 'success',
					title: title
				})
			<?php } else if ($this->session->flashdata('flash') == 'error') { ?>
				var title = '<?php echo $this->session->flashdata('message') ?>';
				Toast.fire({
					icon: 'error',
					title: title
				})
			<?php } ?>
		});
	</script>
</html>