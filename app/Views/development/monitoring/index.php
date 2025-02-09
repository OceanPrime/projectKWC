<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Project KCW</h4>
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
			<script>
                <?php if (session()->has('swal_error')): ?>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: '<?= session('swal_error'); ?>',
                    });
                <?php endif; ?>

                <?php if (session()->has('swal_success')): ?>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: '<?= session('swal_success'); ?>',
                    });
                <?php endif; ?>
            </script>
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
							<a href="<?= base_url('/dev/monitoring-view'); ?>">
								<button class="btn btn-success rounded-pill">
									<i class="fa fa-eye"></i>
									View Project
								</button>
							</a>
						</div>
						<div class="card-body">
							<div class="card full-height">
								<div class="monitoring-container">
									<div class="monitoring-row">
										<div>
											<div class="label">Customer :</div>
											<select class="value" id="customer-dropdown" name="customer_id">
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
											<select class="value" id="project-dropdown" name="project_id">
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
											<div class="date-input">
												<input type="date" id="die-go-date" readonly>
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
										<div id="maspro-date-value" class="value">-</div>

										</div>
										<div>
											<div class="label">REMARK PIC :</div>
											<select class="value" id="remark-pic-dropdown" name="remark_pic">
												<option value="">-- Select PIC --</option>
											</select>
											<textarea class="form-control" id="remark-pic-textarea" rows="5" readonly></textarea>
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
											<th>Lead Time Planning</th>
											<th>Lead Time Actual</th>
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
        $.ajax({
            url: '<?= base_url('monitoring/remarks/') ?>' + projectId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var dropdown = $('#remark-pic-dropdown');
                dropdown.empty().append('<option value="">-- Select PIC --</option>');

                if (response.length > 0) {
                    response.forEach(function(item) {
                        dropdown.append('<option value="' + item.pic_id + '" data-remark="' + item.remark + '">' + item.pic_name + '</option>');
                    });
                    dropdown.prop('disabled', false); // Aktifkan dropdown
                } else {
                    dropdown.append('<option value="">No PIC available</option>');
                    dropdown.prop('disabled', true);
                }
                
                $('#remark-pic-textarea').val(''); // Kosongkan textarea
            },
            error: function(xhr, status, error) {
                console.error("Failed to fetch PIC:", xhr.responseText);
                dropdown.append('<option value="">Failed to load</option>');
            }
        });
    } else {
        $('#remark-pic-dropdown').empty().append('<option value="">-- Select PIC --</option>').prop('disabled', true);
        $('#remark-pic-textarea').val('');
    }
});

$('#remark-pic-dropdown').change(function() {
    var remark = $(this).find(':selected').data('remark');
    $('#remark-pic-textarea').val(remark || 'Tidak ada remark tersedia');
});













	$('#project-dropdown').change(function() {
		var projectId = $(this).val();

		if (projectId) {
			// Ambil detail project (jenis, material, status)
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
					alert('Failed to fetch project details.');
				}
			});

			// Ambil Die Go Date
			$.ajax({
				url: '<?= base_url('monitoring/getPlanFinish/') ?>' + projectId,
				type: 'GET',
				dataType: 'json',
				success: function(response) {
					console.log("Die Go Date fetched:", response);
					if (response.die_go) {
						$('#die-go-date').val(response.die_go);
					} else {
						$('#die-go-date').val('');
					}
				},
				error: function(xhr, status, error) {
					console.error("Failed to fetch Die Go Date:", xhr.responseText);
					alert('Failed to fetch Die Go Date.');
				}
			});

			// Ambil Maspro Date dan Task List
			$.ajax({
				url: '<?= base_url('monitoring/tasks/') ?>' + projectId,
				type: 'GET',
				dataType: 'json',
				success: function(response) {
					console.log("Maspro Date & Tasks fetched:", response);
					
					let tasks = response.tasks;
					let masproDate = response.maspro_date ? response.maspro_date : 'Belum Ada Data';

					// Tampilkan MASSPRO DATE
					$('#maspro-date-value').text(masproDate);

					// Update tabel tasks
					var tbody = $('#tasks-table tbody');
					tbody.html('');
					tasks.forEach(function(task) {
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
					console.error("Failed to fetch Maspro Date & Tasks:", xhr.responseText);
					alert('Failed to fetch Maspro Date & Tasks.');
				}
			});

    } else {
        alert('Please select a project.');
    }
});


	});
</script>

<?= $this->endSection(); ?>