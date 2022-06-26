<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>BUPDA</title>
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
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>animate.css"/>
	<link rel="shortcut icon" href="<?= base_url('assets/images/bupda.png') ?>" />
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
			<!-- Notif -->
			<ul class="navbar-nav ml-auto">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="far fa-bell"></i>
						<span class="badge badge-warning navbar-badge notif-count"></span>
					</a>
					<div class="dropdown-menu drop-admin drop-menu dropdown-menu-lg dropdown-menu-right">
					</div>
				</li>
			</ul>
			<ul class="navbar-nav">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="far fa-user"></i> <?= $_SESSION['admin']->username; ?>
					</a>
					<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
						<div class="dropdown-divider"></div>
						<a href="<?= base_url('authentication/logoutAdmin') ?>" class="dropdown-item dropdown-footer">Logout</a>
					</div>
				</li>
			</ul>
		</nav>
		<!-- Main Sidebar Container -->
		<aside class="main-sidebar elevation-2">
			<!-- Brand Logo -->
			<a href="<?= base_url('admin') ?>" class="brand-link">
				<img src="<?= base_url('assets/images/bupda.png') ?>" alt="grocery" class="brand-image" style="opacity: .8">
				<span class="brand-text font-weight-bold">BUPDA</span>
			</a>
			<!-- Sidebar -->
			<div class="sidebar sidebar-fixed">
				<div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
					<div class="image">
						<img src="<?= base_url('assets/images/'); ?>avatar.png" class="img-circle elevation-2" alt="User Image">
					</div>
					<div class="info">
						<a href="<?= base_url('admin') ?>" class="d-block">
							<?= isset($_SESSION['admin']) ? $_SESSION['admin']->username . ' <br> Area: ' . $_SESSION['admin']->nama_area . ' <br> Role: ' . $_SESSION['admin']->nama_role : '' ?>
						</a>
					</div>
				</div>
				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
						<li class="nav-item">
							<a href="<?= base_url('admin') ?>" class="nav-link <?= (current_url() == base_url('admin/dashboard')) || (current_url() == base_url('admin')) ? 'active' : '' ?>">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>DASHBOARD </p>
							</a>
						</li>
						<?php
						// Links for Undian
						$orders = array(
							base_url("admin/orders"),
							base_url("admin/orders/menunggu"),
							base_url("admin/orders/diproses"),
							base_url("admin/orders/siap"),
							base_url('admin/orders/diambil'),
							base_url('admin/orders/dikirim'),
							base_url('admin/orders/selesai'),
							base_url('admin/orders/batal'),
							base_url("admin/orders/ambil_sendiri"),
							base_url("admin/orders/dikirim"),
							base_url("admin/orders/diterima")
						);
						?>
						<li class="nav-item <?php if (in_array(current_url(), $orders)) echo "menu-open"; ?>">
							<a href="#" class="nav-link <?php if (in_array(current_url(), $orders)) echo "active"; ?>">
								<i class="nav-icon fas fa-shopping-bag"></i>
								<p>ORDERS<i class="right fas fa-angle-left"></i></p>
							</a>
							<?php
							$semua_order = $this->Settings_model->countAllOrdersItemByAdmin();
							$menunggu_order = $this->Settings_model->countWaitingOrdersItemByAdmin();
							$diproses_order = $this->Settings_model->countProcessingOrdersItemByAdmin();
							$siap_order = $this->Settings_model->countReadyOrdersItemByAdmin();
							$ambil_sendiri = $this->Settings_model->countPickupOrdersItemByAdmin();
							$delivery_order = $this->Settings_model->countDeliveryOrdersItemByAdmin();
							$received_order = $this->Settings_model->countReceivedOrdersItemByAdmin();
							$completed_order = $this->Settings_model->countCompleteOrdersItemByAdmin();
							$canceled_order = $this->Settings_model->countCancelOrdersItemByAdmin();
							?>
							<ul class="nav nav-treeview">
								<?php if ($_SESSION['admin']->nama_role != 'gudang') : ?>
									<li class="nav-item">
										<a href="<?= base_url('admin/orders') ?>" class="nav-link <?= (current_url() == base_url('admin/orders')) ? 'active' : '' ?>">
											<i class="nav-icon far fa-file-alt"></i>
											<p>Semua Order (<?= $semua_order ?>) </p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url('admin/orders/menunggu') ?>" class="nav-link <?= (current_url() == base_url('admin/orders/menunggu')) ? 'active' : '' ?>">
											<i class="nav-icon fas fa-clock"></i>
											<p>Menunggu (<?= $menunggu_order ?>) </p>
										</a>
									</li>
								<?php endif; ?>
								<li class="nav-item">
									<a href="<?= base_url("admin/orders/diproses") ?>" class="nav-link <?= (current_url() == base_url("admin/orders/diproses")) ? 'active' : '' ?>">
										<i class="nav-icon fas fa-tasks"></i>
										<p>Diproses (<?= $diproses_order ?>)</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url("admin/orders/siap") ?>" class="nav-link <?= (current_url() == base_url('admin/orders/siap')) ? 'active' : '' ?>">
										<i class="nav-icon 	fas fa-box"></i>
										<p>Barang Siap (<?= $siap_order ?>)</p>
									</a>
								</li>
								<?php if ($_SESSION['admin']->nama_role != 'gudang') : ?>
									<li class="nav-item">
										<a href="<?= base_url("admin/orders/ambil_sendiri") ?>" class="nav-link <?= (current_url() == base_url('admin/orders/ambil_sendiri')) ? 'active' : '' ?>">
											<i class="nav-icon 	fas fa-people-carry"></i>
											<p>Ambil Sendiri (<?= $ambil_sendiri ?>)</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url("admin/orders/dikirim") ?>" class="nav-link <?= (current_url() == base_url('admin/orders/dikirim')) ? 'active' : '' ?>">
											<i class="nav-icon 	fas fa-truck"></i>
											<p>Dikirim (<?= $delivery_order ?>)</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url("admin/orders/diterima") ?>" class="nav-link <?= (current_url() == base_url('admin/orders/diterima')) ? 'active' : '' ?>">
											<i class="nav-icon 	fas fa-box-open"></i>
											<p>Diterima (<?= $received_order ?>)</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url("admin/orders/selesai") ?>" class="nav-link <?= (current_url() == base_url('admin/orders/selesai')) ? 'active' : '' ?>">
											<i class="nav-icon 	fas fa-check"></i>
											<p>Selesai (<?= $completed_order ?>)</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url("admin/orders/batal") ?>" class="nav-link <?= (current_url() == base_url('admin/orders/batal')) ? 'active' : '' ?>">
											<i class="nav-icon fas fa-exclamation-triangle"></i>
											<p>Batal (<?= $canceled_order ?>)</p>
										</a>
									</li>
								<?php endif; ?>
							</ul>
						</li>
						<li class="nav-item">
							<a href="<?= base_url("admin/stock") ?>" class="nav-link <?= (current_url() == base_url('admin/stock')) ? 'active' : '' ?>">
								<i class="nav-icon 	fas fa-box"></i>
								<p>STOCK</p>
							</a>
						</li>
						<?php if ($_SESSION['admin']->nama_role != 'gudang') : ?>
							<li class="nav-item">
								<a href="<?= base_url("admin/laporan") ?>" class="nav-link <?= (current_url() == base_url('admin/orders/report')) ? 'active' : '' ?>">
									<i class="nav-icon 	fas fa-file-alt"></i>
									<p>LAPORAN</p>
								</a>
							</li>
							<!-- ==========PRODUK========== -->
							<?php
							// Links for PRODUK
							$products = array(
								base_url("admin/products"),
								base_url('admin/category'),
								base_url("admin/products/unit"),
							);
							?>
							<li class="nav-item 
								<?php if (in_array(current_url(), $products)) {
									echo "menu-open";
								} ?>">
								<a href="#" class="nav-link 
								<?php if (in_array(current_url(), $products)) {
									echo "active";
								} ?>">
									<i class="nav-icon fas fa-warehouse"></i>
									<p>PRODUK<i class="right fas fa-angle-left"></i></p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="<?= base_url("admin/products") ?>" class="nav-link <?= (current_url() == base_url('admin/products')) ? 'active' : '' ?>">
											<i class="nav-icon fas fa-cubes"></i>
											<p>Daftar Produk</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url("admin/category") ?>" class="nav-link <?= (current_url() == base_url('admin/category')) ? 'active' : '' ?>">
											<i class="nav-icon fas fa-cubes"></i>
											<p>Kategori Produk</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url("admin/products/unit") ?>" class="nav-link <?= (current_url() == base_url('admin/products/unit')) ? 'active' : '' ?>">
											<i class="nav-icon fas fa-cubes"></i>
											<p>Unit Produk</p>
										</a>
									</li>
								</ul>
							</li>
							<!-- ==========CUSTOMERS========== -->
							<?php
							// Links for CUSTOMERS
							if (isset($data)) {
								$link_edit = base_url("admin/customers/edit/" . isset($data) ? $data[0]->id : "null");
							} else {
								$link_edit = null;
							}
							$customers = array(
								base_url("admin/customers"),
								base_url('admin/customers/predefined'),
								base_url('admin/warung'),
								base_url('admin/kurir'),
								$link_edit,
								base_url("admin/customers/add"),
							);
							?>
							<li class="nav-item 
								<?php if (in_array(current_url(), $customers)) {
									echo "menu-open";
								} ?>">
								<a href="#" class="nav-link 
								<?php if (in_array(current_url(), $customers)) {
									echo "active";
								} ?>">
									<i class="nav-icon fas fa-user-circle"></i>
									<p>USERS<i class="right fas fa-angle-left"></i></p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="<?= base_url('admin/customers') ?>" class="nav-link <?= urldecode(uri_string()) == 'admin/customers' ? 'active' : '' ?>">
											<i class="nav-icon fas fa-users"></i>
											<p>Customers</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url('admin/customers/predefined') ?>" class="nav-link <?= urldecode(uri_string()) == 'admin/customers/predefined' ? 'active' : '' ?>">
											<i class="nav-icon fas fa-id-card"></i>
											<p>Predefined Customers</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url('admin/warung') ?>" class="nav-link <?= urldecode(uri_string()) == 'admin/warung' ? 'active' : '' ?>">
											<i class="nav-icon fas fa-users"></i>
											<p>Warung</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url('admin/kurir') ?>" class="nav-link <?= urldecode(uri_string()) == 'admin/kurir' ? 'active' : '' ?>">
											<i class="nav-icon fas fa-shipping-fast"></i>
											<p>Kurir</p>
										</a>
									</li>
								</ul>
							</li>
							<li class="nav-item">
								<a href="<?= base_url("admin/banner") ?>" class="nav-link <?= (current_url() == base_url('admin/banner')) ? 'active' : '' ?>">
									<i class="nav-icon fas fa-images"></i>
									<p>BANNER</p>
								</a>
							</li>
						<?php endif; ?>
						<?php if ($_SESSION['admin']->nama_role == "superadmin") { ?>
							<!-- ==========MASTER AREA========== -->
							<?php
							// Links for master_area
							$master_area = array(
								base_url("admin/provinsi"), base_url("admin/kecamatan"),
								base_url('admin/kabupaten'), base_url('admin/kelurahan'),
							);
							?>
							<li class="nav-item 
								<?php if (in_array(current_url(), $master_area)) {
									echo "menu-open";
								} ?>">
								<a href="#" class="nav-link 
								<?php if (in_array(current_url(), $master_area)) {
									echo "active";
								} ?>">
									<i class="nav-icon fas fa-map"></i>
									<p>MASTER AREA<i class="right fas fa-angle-left"></i></p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="<?= base_url('admin/provinsi') ?>" class="nav-link <?= (current_url() == base_url('admin/provinsi')) ? 'active' : '' ?>">
											<i class="nav-icon fas fa-map-marker-alt"></i>
											<p>Provinsi</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url('admin/kabupaten') ?>" class="nav-link <?= (current_url() == base_url('admin/kabupaten')) ? 'active' : '' ?>">
											<i class="nav-icon fas fa-map-marker-alt"></i>
											<p>Kabupaten</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url('admin/kecamatan') ?>" class="nav-link <?= (current_url() == base_url('admin/kecamatan')) ? 'active' : '' ?>">
											<i class="nav-icon fas fa-map-marker-alt"></i>
											<p>Kecamatan</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url('admin/kelurahan') ?>" class="nav-link <?= (current_url() == base_url('admin/kelurahan')) ? 'active' : '' ?>">
											<i class="nav-icon fas fa-map-marker-alt"></i>
											<p>Kelurahan</p>
										</a>
									</li>
								</ul>
							</li>
						<?php } else {
						} ?>
						<!-- ========== SETTINGS ========== -->
						<?php
						// Links for users
						$settings = array(
							base_url('admin/role'), base_url("admin/settings"), base_url("admin/warung/level"),
							base_url('admin/admins'), base_url("admin/logs"), base_url("admin/area")
						);
						?>
						<?php if ($_SESSION['admin']->nama_role != "gudang") { ?>
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
									<?php if ($_SESSION['admin']->nama_role == "superadmin") { ?>
										<li class="nav-item">
											<a href="<?= base_url('admin/admins') ?>" class="nav-link <?= (current_url() == base_url('admin/admins')) ? 'active' : '' ?>">
												<i class="nav-icon fas fa-user-cog"></i>
												<p>Admins</p>
											</a>
										</li>
									<?php } else {
									} ?>
									<?php if ($_SESSION['admin']->nama_role == "superadmin") { ?>
										<li class="nav-item">
											<a href="<?= base_url("admin/role") ?>" class="nav-link <?= (current_url() == base_url('admin/role')) ? 'active' : '' ?>">
												<i class="nav-icon fas fa-id-card-alt"></i>
												<p>Role User</p>
											</a>
										</li>
									<?php } else {
									} ?>
									<?php if ($_SESSION['admin']->nama_role == "superadmin") { ?>
										<li class="nav-item">
											<a href="<?= base_url("admin/area") ?>" class="nav-link <?= (current_url() == base_url('admin/area')) ? 'active' : '' ?>">
												<i class="nav-icon fas fa-map-marker-alt"></i>
												<p>Area User</p>
											</a>
										</li>
									<?php } else {
									} ?>
									<?php if ($_SESSION['admin']->nama_role == "superadmin") { ?>
										<li class="nav-item">
											<a href="<?= base_url("admin/warung/level") ?>" class="nav-link <?= (current_url() == base_url('admin/warung/level')) ? 'active' : '' ?>">
												<i class="nav-icon fas fa-balance-scale"></i>
												<p>Level Warung</p>
											</a>
										</li>
									<?php } else {
									} ?>
									<li class="nav-item">
										<a href="<?= base_url("admin/settings") ?>" class="nav-link <?= (current_url() == base_url('admin/settings')) ? 'active' : '' ?>">
											<i class="nav-icon fas fa-cog"></i>
											<p>System Settings</p>
										</a>
									</li>
									<?php if ($_SESSION['admin']->nama_role == "superadmin") { ?>
										<li class="nav-item">
											<a href="<?= base_url("admin/logs") ?>" class="nav-link <?= (current_url() == base_url('admin/logs')) ? 'active' : '' ?>">
												<i class="nav-icon fas fa-eye"></i>
												<p>System Logs</p>
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
			<strong>Copyright &copy; <a href="https://bimasaktisanjaya.id">Bima Sakti Sanjaya 2022</a>.</strong> All rights reserved.
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
	function load_notification(view = '') {
		var urls = " <?php if ($_SESSION['admin']->nama_role == "superadmin") {
										echo base_url('superadmin/fetch');
									} else if ($_SESSION['admin']->nama_role == "admin") {
										echo base_url('admin/fetch/' . $_SESSION['admin']->id);
									} ?>";
		$.ajax({
			url: urls,
			method: "POST",
			data: {
				view: view
			},
			dataType: "json",
			success: function(data) {
				$('.drop-admin').html(data.notification);
				if (data.unseen_notification > 0) {
					$('.notif-count').html(data.unseen_notification);
				}
			}
		});
	}
	// calling to load new notif
	load_notification();
	$('.dropdown-toggle').click(function() {
		$('.notif-count').html('');
		load_notification('yes');
	});
	$(function() {
		$('#table').DataTable({});
		$('#table-logs').DataTable({
			"order": [
				[4, "desc"]
			],
		});
		$('#table_export').DataTable({
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

<!-- Modal -->
<div class="modal fade" id="viewBuktiBayar" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="viewBuktiBayarLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="viewBuktiBayarLabel">Bukti Bayar</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="buktiBayar">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>
<script>
	//SHOW BuktiBayar
	$('body').on('click', '.bukti-bayar', function() {
		var data_id = $(this).data('id');
		$.ajax({
			url: '<?=base_url('Orders/showBuktiBayar/')?>' + data_id,
			method: 'post',
			data: {
				id: data_id
			},
			success: function(data) {
				$('#buktiBayar').html(data);
				$('#viewBuktiBayar').modal("show");
			}
		});
	});
</script>
</html>