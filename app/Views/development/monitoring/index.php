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
							<a href="<?= base_url('/dev/monitoring-tambah'); ?>">
								<button class="btn btn-primary rounded-pill">
									<i class="fa fa-plus"></i>
									Add Project
								</button>
							</a>
						</div>
						<div class="card-body">
							<div class="card full-height">
								<div class="monitoring-container">
									<div class="monitoring-row">
										<div>
											<div class="label">Customer :</div>
											<select id="customer-dropdown" name="customer_id">
												<option value="">-- Select Customer --</option>
												<?php foreach ($customers as $customer): ?>
													<option value="<?= $customer['customer_id']; ?>"><?= $customer['customer_name']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<div>
											<div class="label">JENIS :</div>
											<div id="jenis-value" class="value">-</div>
										</div>
									</div>
									<div class="monitoring-row">
										<div>
											<div class="label">Project :</div>
											<select id="project-dropdown" name="project_id">
												<option value="">-- Select Project --</option>
											</select>
										</div>
										<div>
											<div class="label">MATERIAL :</div>
											<div id="material-value" class="value">-</div>
										</div>
									</div>
									<div class="monitoring-row">
										<div>
											<div class="label">DIE - GO DATE :</div>
											<div id="" class="date-input">
												<input type="date">
											</div>
										</div>
										<div>
											<div class="label">STATUS :</div>
											<div id="status-value" class="value">-</div>
										</div>
									</div>
									<div class="monitoring-row">
										<div>
											<div class="label">MASSPRO DATE :</div>
											<div class="date-input">
												<input type="date">
											</div>
										</div>
										<div>
											<div class="label">REMARK PIC :</div>
											<div id="" class="value">-</div>
										</div>

									</div>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="tasks-table" class="display table table-striped table-hover">
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
									<tbody></tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#customer-dropdown').change(function() {
			var customerId = $(this).val();
			var projectDropdown = $('#project-dropdown');
			var jenis = $('#jenis-value');
			var material = $('#material-value');
			var status = $('#status-value');

			// Reset dropdown dan detail
			projectDropdown.html('<option value="">-- Select Project --</option>');
			jenis.text('-');
			material.text('-');
			status.text('-');

			// Reset tabel
			$('#tasks-table tbody').html('');

			if (customerId) {
				// Fetch projects based on customer
				$.ajax({
					url: '<?= base_url('monitoring/projects/') ?>' + customerId,
					type: 'GET',
					dataType: 'json',
					success: function(response) {
						console.log("Projects fetched:", response);
						response.forEach(function(project) {
							projectDropdown.append('<option value="' + project.id + '">' + project.model_name + '</option>');
						});
					},
					error: function(xhr, status, error) {
						console.error("Failed to fetch projects:", xhr.responseText);
						alert('Failed to fetch projects. See console for details.');
					}
				});
			} else {
				alert('Please select a customer.');
			}
		});

		$('#project-dropdown').change(function() {
			var projectId = $(this).val();

			if (projectId) {
				// Fetch project details
				$.ajax({
					url: '<?= base_url('monitoring/details/') ?>' + projectId,
					type: 'GET',
					dataType: 'json',
					success: function(response) {
						console.log("Project details fetched:", response);
						$('#jenis-value').text(response.jenis);
						$('#material-value').text(response.material);
						$('#status-value').text(response.status);
					},
					error: function(xhr, status, error) {
						console.error("Failed to fetch project details:", xhr.responseText);
						alert('Failed to fetch project details. See console for details.');
					}
				});

				// Fetch tasks for the project
				$.ajax({
					url: '<?= base_url('monitoring/tasks/') ?>' + projectId,
					type: 'GET',
					dataType: 'json',
					success: function(response) {
						console.log("Tasks fetched:", response);
						var tbody = $('#tasks-table tbody');
						tbody.html('');
						response.forEach(function(task) {
							tbody.append(`
                                <tr>
                                    <td>${task.task_name}</td>
                                    <td>${task.pic_name}</td>
                                    <td>${task.status}</td>
                                    <td>${task.start_plan} / ${task.start_actual}</td>
                                    <td>${task.finish_plan} / ${task.finish_actual}</td>
                                    <td>${task.gap_sd}</td>
                                    <td>${task.gap_fd}</td>
                                    <td>${task.leap_time_planning}</td>
                                    <td>${task.leap_time_actual}</td>
                                </tr>
                            `);
						});
					},
					error: function(xhr, status, error) {
						console.error("Failed to fetch tasks:", xhr.responseText);
						alert('Failed to fetch tasks. See console for details.');
					}
				});
			} else {
				alert('Please select a project.');
			}
		});
	});
</script>

<?= $this->endSection(); ?>