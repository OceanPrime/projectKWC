<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title><?= $title; ?></title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="<?= base_url('../assets/img/icon.ico'); ?>" type="image/x-icon" />

	<!-- Fonts and icons -->
	<script src="<?= base_url('../assets/js/plugin/webfont/webfont.min.js'); ?>"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
		WebFont.load({
			google: {
				"families": ["Lato:300,400,700,900"]
			},
			custom: {
				"families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
				urls: ['<?= base_url('../assets/css/fonts.min.css'); ?>']
			},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



	<!-- CSS Files -->
	<link rel="stylesheet" href="<?= base_url('../assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('../assets/css/atlantis.min.css'); ?>">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="<?= base_url('../assets/css/demo.css'); ?>">

	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f9f9f9;
		}

		.monitoring-container {
			background-color: #fff;
			border: 1px solid #ddd;
			border-radius: 8px;
			padding: 20px;
			width: 100%;
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
		}

		.monitoring-header {
			font-size: 18px;
			font-weight: bold;
			margin-bottom: 10px;
		}

		.monitoring-row {
			display: flex;
			justify-content: space-between;
			margin-bottom: 10px;
		}

		.monitoring-row div {
			width: 48%;
		}

		.label {
			font-weight: bold;
		}

		.value {
			background-color: #f1f1f1;
			padding: 5px;
			border-radius: 4px;
			text-align: center;
		}

		select.value {
			width: 48%;
			padding: 5px;
			border-radius: 4px;
			border: 1px solid #ddd;
			background-color: #f1f1f1;
			font-size: 14px;
		}

		.date-input {
			display: flex;
			align-items: center;
			width: 100%;
			/* Tambahkan ini */
		}

		.date-input input {
			width: 100%;
			/* Samakan ukuran dengan select */
			padding: 5px;
			/* Samakan padding dengan select */
			border-radius: 4px;
			/* Samakan border-radius */
			border: 1px solid #ddd;
			/* Samakan border */
			background-color: #f1f1f1;
			/* Samakan background */
			font-size: 14px;
			/* Samakan font-size */
			text-align: center;
		}

		.date-input input[type="date"]::-webkit-calendar-picker-indicator {
			cursor: pointer;
		}
	</style>

	<style>
		.logo {
			display: flex;
			align-items: center;
			height: 50px;
			margin-left: -25px;
		}

		.logo img {
			max-height: 40px;
			object-fit: contain;
			width: 100%;
		}
	</style>
</head>

<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">

				<a href="index.html" class="logo">
					<img src="<?= base_url('../assets/img/chemco2.png'); ?>" alt="navbar brand" class="navbar-brand">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
				<div class="container-fluid">

				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- MAIN CONTENT -->
		<?= $this->renderSection('contentApproval'); ?>
		<!-- END CONTENT -->

		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="<?= base_url('../assets/img/PIC.png'); ?>" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="<?= base_url(''); ?>#collapseExample" aria-expanded="true">
								<span>
									<?= esc($nama); ?>
									<span class="user-level"><?= esc($role); ?></span>
								</span>
							</a>
						</div>
					</div>
					<ul class="nav nav-primary">
						<li class="nav-item active">
							<a href="<?= base_url('/PIC'); ?>" class="collapsed" aria-expanded="false">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('/PIC/TASK'); ?>">
								<i class="fas fa-desktop"></i>
								<p>TASK</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('/logout'); ?>">
								<i class="fas fa-sign-out-alt"></i>
								<p>Log out</p>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->

	</div>
	<!--   Core JS Files   -->
	<script src="<?= base_url('../assets/js/core/jquery.3.2.1.min.js'); ?>"></script>
	<script src="<?= base_url('../assets/js/core/popper.min.js'); ?>"></script>
	<script src="<?= base_url('../assets/js/core/bootstrap.min.js'); ?>"></script>

	<!-- jQuery UI -->
	<script src="<?= base_url('../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js'); ?>"></script>
	<script src="<?= base_url('../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js'); ?>"></script>

	<!-- jQuery Scrollbar -->
	<script src="<?= base_url('../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js'); ?>"></script>


	<!-- Chart JS -->
	<script src="<?= base_url('../assets/js/plugin/chart.js/chart.min.js'); ?>"></script>

	<!-- jQuery Sparkline -->
	<script src="<?= base_url('../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js'); ?>"></script>

	<!-- Chart Circle -->
	<script src="<?= base_url('../assets/js/plugin/chart-circle/circles.min.js'); ?>"></script>

	<!-- Datatables -->
	<script src="<?= base_url('../assets/js/plugin/datatables/datatables.min.js'); ?>"></script>

	<!-- Bootstrap Notify -->
	<script src="<?= base_url('../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js'); ?>"></script>

	<!-- jQuery Vector Maps -->
	<script src="<?= base_url('../assets/js/plugin/jqvmap/jquery.vmap.min.js'); ?>"></script>
	<script src="<?= base_url('../assets/js/plugin/jqvmap/maps/jquery.vmap.world.js'); ?>"></script>

	<!-- Sweet Alert -->
	<script src="<?= base_url('../assets/js/plugin/sweetalert/sweetalert.min.js'); ?>"></script>

	<!-- Atlantis JS -->
	<script src="<?= base_url('../assets/js/atlantis.min.js'); ?>"></script>

	<!--   Core JS Files   -->
	<script src="<?= base_url('../../assets/js/core/jquery.3.2.1.min.js'); ?>"></script>
	<script src="<?= base_url('../../assets/js/core/popper.min.js'); ?>"></script>
	<script src="<?= base_url('../../assets/js/core/bootstrap.min.js'); ?>"></script>
	<!-- jQuery UI -->
	<script src="<?= base_url('../../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js'); ?>"></script>
	<script src="<?= base_url('../../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js'); ?>"></script>

	<!-- jQuery Scrollbar -->
	<script src="<?= base_url('../../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js'); ?>"></script>
	<!-- Datatables -->
	<script src="<?= base_url('../../../assets/js/plugin/datatables/datatables.min.js'); ?>"></script>
	<!-- Atlantis JS -->
	<script src="<?= base_url('../../assets/js/atlantis.min.js'); ?>"></script>
	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="<?= base_url('../../assets/js/setting-demo2.js'); ?>"></script>

	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="<?= base_url('../assets/js/setting-demo.js'); ?>"></script>
	<script src="<?= base_url('../assets/js/demo.js'); ?>"></script>
	<script>
		Circles.create({
			id: 'circles-1',
			radius: 45,
			value: 60,
			maxValue: 100,
			width: 7,
			text: 5,
			colors: ['#f1f1f1', '#FF9E27'],
			duration: 400,
			wrpClass: 'circles-wrp',
			textClass: 'circles-text',
			styleWrapper: true,
			styleText: true
		})

		Circles.create({
			id: 'circles-2',
			radius: 45,
			value: 70,
			maxValue: 100,
			width: 7,
			text: 36,
			colors: ['#f1f1f1', '#2BB930'],
			duration: 400,
			wrpClass: 'circles-wrp',
			textClass: 'circles-text',
			styleWrapper: true,
			styleText: true
		})

		Circles.create({
			id: 'circles-3',
			radius: 45,
			value: 40,
			maxValue: 100,
			width: 7,
			text: 12,
			colors: ['#f1f1f1', '#F25961'],
			duration: 400,
			wrpClass: 'circles-wrp',
			textClass: 'circles-text',
			styleWrapper: true,
			styleText: true
		})

		var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

		var mytotalIncomeChart = new Chart(totalIncomeChart, {
			type: 'bar',
			data: {
				labels: ["S", "M", "T", "W", "T", "F", "S", "S", "M", "T"],
				datasets: [{
					label: "Total Income",
					backgroundColor: '#ff9e27',
					borderColor: 'rgb(23, 125, 255)',
					data: [6, 4, 9, 5, 4, 6, 4, 3, 8, 10],
				}],
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				legend: {
					display: false,
				},
				scales: {
					yAxes: [{
						ticks: {
							display: false //this will remove only the label
						},
						gridLines: {
							drawBorder: false,
							display: false
						}
					}],
					xAxes: [{
						gridLines: {
							drawBorder: false,
							display: false
						}
					}]
				},
			}
		});

		$('#lineChart').sparkline([105, 103, 123, 100, 95, 105, 115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: '#ffa534',
			fillColor: 'rgba(255, 165, 52, .14)'
		});
	</script>

	<script>
		$(document).ready(function() {
			$('#basic-datatables').DataTable({});

			$('#multi-filter-select').DataTable({
				"pageLength": 5,
				initComplete: function() {
					this.api().columns().every(function() {
						var column = this;
						var select = $('<select class="form-control"><option value=""></option></select>')
							.appendTo($(column.footer()).empty())
							.on('change', function() {
								var val = $.fn.dataTable.util.escapeRegex(
									$(this).val()
								);

								column
									.search(val ? '^' + val + '$' : '', true, false)
									.draw();
							});

						column.data().unique().sort().each(function(d, j) {
							select.append('<option value="' + d + '">' + d + '</option>')
						});
					});
				}
			});

			// Add Row
			$('#add-row').DataTable({
				"pageLength": 5,
			});

			var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

			$('#addRowButton').click(function() {
				$('#add-row').dataTable().fnAddData([
					$("#addName").val(),
					$("#addPosition").val(),
					$("#addOffice").val(),
					action
				]);
				$('#addRowModal').modal('hide');

			});
		});
	</script>
</body>

</html>