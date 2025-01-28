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
                        <a href="#">Add PROJECT</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">ADD PROJECT PIC</h4>
                        </div>
                        <?php if (session()->get('errors')): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php foreach (session()->get('errors') as $error): ?>
                                        <li><?= $error ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div class="card-body">
                            <form class="form" action="/monitoring-save" method="post">
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <!-- Dropdown Customer -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="customer-dropdown">Customer</label>
                                            <select id="customer-dropdown" class="form-control" name="customer_id">
                                                <option value="">-- Select Customer --</option>
                                                <?php foreach ($customers as $customer): ?>
                                                    <option value="<?= $customer['customer_id']; ?>"><?= $customer['customer_name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Dropdown Project -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="project-dropdown">Project</label>
                                            <select id="project-dropdown" class="form-control" name="model_id" disabled>
                                                <option value="">-- Select Project --</option>
                                            </select>
                                        </div>
                                    </div>


                                    <!-- Date Input for DIE-GO -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="die_go">DIE-GO</label>
                                            <input type="date" id="die_go" class="form-control" name="die_go" value="" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="plan_finish">Maspro Date</label>
                                            <input type="date" id="plan_finish" class="form-control" name="finish_plan" value="">
                                        </div>
                                    </div>

                                                    
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="customer-dropdown" for="defaultSelect">PIC</label>
                                            <select id="customer-dropdown"  class="form-control" name="pic_id">
                                                <option value="">-- Select PIC --</option>
                                                <?php foreach ($users as $user): ?>
                                                    <option value="<?= $user['user_id']; ?>">
                                                        <?= $user['nama'] . ' (' . $user['role'] . ')'; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Submit and Cancel Buttons -->
                                    <div class="col-12 d-flex justify-content-start">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        <a href="<?= base_url('/dev/monitoring'); ?>" class="btn btn-danger me-1 mb-1">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">ADD TASK PIC</h4>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <div class="container mt-4">
                                <!-- Form pertama -->
                                <form id="mainForm">
                                    <div class="row mb-3">
                                        <div class="form-group">
                                            <div class="col-lg-14">
                                                <label for="customer-dropdown">PIC</label>
                                                <select id="customer-dropdown" class="form-control" name="pic_id">
                                                    <option value="">-- Select PIC --</option>
                                                    <?php foreach ($users as $user): ?>
                                                        <option value="<?= $user['user_id']; ?>">
                                                            <?= $user['nama'] . ' (' . $user['role'] . ')'; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-14">
                                                <label for="planStart" class="form-label">Plan Start</label>
                                                <input type="date" class="form-control" id="planStart" name="planStart[]">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-14">
                                                <label for="planFinish" class="form-label">Plan Finish</label>
                                                <input type="date" class="form-control" id="planFinish" name="planFinish[]">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-14">
                                                <label for="taskPic" class="form-label">Task PIC</label>
                                                <input type="text" class="form-control" id="taskPic" name="taskPic[]">
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <!-- Tempat form tambahan -->
                                <div id="extraForms"></div>

                                <!-- Tombol tambah form -->
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="button" class="btn btn-primary me-1 mb-1" id="addFormButton">
                                        <i class="fa fa-plus"></i> Add TASK
                                    </button>
                                    <a href="<?= base_url('/dev/monitoring'); ?>" class="btn btn-danger me-1 mb-1">Cancel</a>
                                </div>
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
        // Synchronize Plan Start with Die Go
        $('#die_go').on('change', function() {
            var dieGoValue = $(this).val();
            $('#plan_start').val(dieGoValue);
        });

        // Load projects when a customer is selected
        $('#customer-dropdown').change(function() {
            var customerId = $(this).val();

            if (customerId) {
                // Fetch projects for selected customer
                $.ajax({
                    url: '<?= base_url('monitoring/getProjects/') ?>' + customerId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.length > 0) {
                            // Populate project dropdown
                            $('#project-dropdown').empty().append('<option value="">-- Select Project --</option>');
                            $.each(response, function(index, project) {
                                $('#project-dropdown').append('<option value="' + project.id + '">' + project.model_name + '</option>');
                            });
                            $('#project-dropdown').prop('disabled', false);
                        } else {
                            // No projects found
                            $('#project-dropdown').empty().append('<option value="">No projects available</option>');
                            $('#project-dropdown').prop('disabled', true);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Failed to fetch projects:", xhr.responseText);
                        alert('Failed to fetch projects. See console for details.');
                    }
                });
            } else {
                // Reset project dropdown if no customer is selected
                $('#project-dropdown').empty().append('<option value="">-- Select Project --</option>');
                $('#project-dropdown').prop('disabled', true);
            }
        });

        $('form').submit(function(e) {
            if (!$('#customer-dropdown').val() || !$('#project-dropdown').val()) {
                e.preventDefault();
                alert('Please select a Customer and Project.');
            }
        });


        // Load details when a project is selected
        $('#project-dropdown').change(function() {
            var projectId = $(this).val();

            if (projectId) {
                // Fetch project details
                $.ajax({
                    url: '<?= base_url('monitoring/getPlanFinish/') ?>' + projectId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.error) {
                            alert(response.error);
                        } else {
                            // Populate fields with data
                            //$('#plan_finish').val(response.plan_finish);
                            $('#die_go').val(response.die_go);
                            // Synchronize Plan Start with Die Go
                            $('#plan_start').val(response.die_go);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Failed to fetch project details:", xhr.responseText);
                        alert('Failed to fetch project details. See console for details.');
                    }
                });
            } else {
                // Reset fields if no project selected
                //$('#plan_finish').val('');
                $('#die_go').val('');
                $('#plan_start').val('');
            }
        });
    });
</script>

<script>
    document.getElementById("addFormButton").addEventListener("click", function() {
        // Elemen form baru
        const newForm = `
                                    <div class="row mb-3">
                                        <div class="form-group">
                                            <label for="customer-dropdown">PIC</label>
                                            <select id="customer-dropdown" class="form-control" name="pic_id">
                                                <option value="">-- Select PIC --</option>
                                                <?php foreach ($users as $user): ?>
                                                    <option value="<?= $user['user_id']; ?>">
                                                        <?= $user['nama'] . ' (' . $user['role'] . ')'; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-14">
                                                <label for="planStart" class="form-label">Plan Start</label>
                                                <input type="date" class="form-control" id="planStart" name="planStart[]">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-14">
                                                <label for="planFinish" class="form-label">Plan Finish</label>
                                                <input type="date" class="form-control" id="planFinish" name="planFinish[]">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-14">
                                                <label for="taskPic" class="form-label">Task PIC</label>
                                                <input type="text" class="form-control" id="taskPic" name="taskPic[]">
                                            </div>
                                        </div>
                                    </div>
                
        `;

        // Tambahkan form baru ke container
        document.getElementById("extraForms").insertAdjacentHTML("beforeend", newForm);
    });
</script>

<?= $this->endSection(); ?>