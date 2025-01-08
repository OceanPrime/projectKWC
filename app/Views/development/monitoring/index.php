<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Project KWC</h4>
				<ul class="breadcrumbs">
					<li class="nav-home">
						<a href="#">
							<i class="flaticon-home"></i>
						</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="#">Monitoring</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">Monitoring Data</h4>
						</div>
						<div class="card-body">
							<div class="card full-height">
								<div class="monitoring-container">
									<div class="monitoring-row">
										<div>
											<div class="label">Customer :</div>
											<select class="value">
												<option value="ALKATEC" selected>ALKATEC</option>
												<!-- Tambahkan opsi lainnya sesuai kebutuhan -->
											</select>
										</div>
										<div>
											<div class="label">JENIS :</div>
											<div class="value">Roda 4</div>
										</div>
									</div>
									<div class="monitoring-row">
										<div>
											<div class="label">Project :</div>
											<select class="value">
												<option value="ALKATEC" selected>MM1025_15x6.0</option>
												<option value="CUSTOMER_2">CUSTOMER_2</option>
												<option value="CUSTOMER_3">CUSTOMER_3</option>
												<!-- Tambahkan opsi lainnya sesuai kebutuhan -->
											</select>
										</div>
										<div>
											<div class="label">MATERIAL :</div>
											<div class="value">AlSi11</div>
										</div>
									</div>
									<div class="monitoring-row">
										<div>
											<div class="label">DIE - GO DATE :</div>
											<div class="date-input">
												<input type="date" value="2023-01-10">
											</div>
										</div>
										<div>
											<div class="label">STATUS :</div>
											<div class="value">Completed</div>
										</div>
									</div>
									<div class="monitoring-row">
										<div>
											<div class="label">MASSPRO DATE :</div>
											<div class="date-input">
												<input type="date" value="2024-04-28">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="basic-datatables" class="display table table-striped table-hover">
									<thead>
										<tr>
											<th>TASK</th>
											<th>PIC</th>
											<th>STATUS</th>
											<th>START P/A</th>
											<th>FINISH P/A</th>
											<th>GAP S.D(Days)</th>
											<th>GAP F.D(Days)</th>
											<th>Leap Time Planning</th>
											<th>Leap Time Actual</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>ReDrawing</td>
											<td>Aji Bapuk</td>
											<td>COMPLATED-TIME</td>
											<td>
												<p>P (<span>03-Aug-23</span>)</p>
												<p>A (<span>03-Aug-23</span>)</p>
											</td>
											<td>
												<p>P (<span>03-Aug-23</span>)</p>
												<p>A (<span>03-Aug-23</span>)</p>
											</td>
											<td>0</td>
											<td>0</td>
											<td>2</td>
											<td>2</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	<footer class="footer">
		<div class="container-fluid">
			<nav class="pull-left">
				<ul class="nav">
					<li class="nav-item">
						<a class="nav-link" href="https://www.themekita.com">
							ThemeKita
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">
							Help
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">
							Licenses
						</a>
					</li>
				</ul>
			</nav>
			<div class="copyright ml-auto">
				2018, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://www.themekita.com">ThemeKita</a>
			</div>
		</div>
	</footer>
</div>
<?= $this->endSection(); ?>