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

                                <!-- Form Input Utama -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="customer-dropdown">Customer</label>
                                            <select id="customer-dropdown" class="form-control" name="customer_id" required>
                                                <option value="">-- Select Customer --</option>
                                                <?php foreach ($customers as $customer): ?>
                                                    <option value="<?= $customer['customer_id']; ?>"><?= $customer['customer_name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="project-dropdown">Project</label>
                                            <select id="project-dropdown" class="form-control" name="model_id" required>
                                                <option value="">-- Select Project --</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="die_go">DIE-GO</label>
                                            <input type="date" id="die_go" class="form-control" name="die_go" readonly>
                                        </div>
                                    </div>

                                
                                </div>

                                <!-- Form Task PIC -->
                                <div class="card-header">
                                    <h4 class="card-title mt-4">ADD TASK PIC</h4>
                                </div>
                                <div id="taskPicContainer">
                                    <!-- Task PIC Pertama -->
                                    <div class="row mb-3 task-pic-item">
                                        <div class="col-md-3">
                                            <label>PIC</label>
                                            <select class="form-control" name="pic_id[]" value="<?= old('user_id'); ?>" required>
                                                <option value="">-- Select PIC --</option>
                                                <?php foreach ($users as $user): ?>
                                                    <option value="<?= $user['user_id']; ?>"><?= $user['nama'] . ' (' . $user['role'] . ')'; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Plan Start</label>
                                            <input type="date" class="form-control" name="planStart[]" value="<?= old('start_plan'); ?>" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Plan Finish</label>
                                            <input type="date" class="form-control" name="planFinish[]" value="<?= old('finish_plan'); ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tombol Tambah Task PIC -->
                                <div class="col-12 d-flex justify-content-end mt-3">
                                    <button type="button" class="btn btn-primary" id="addTaskButton">
                                        <i class="fa fa-plus"></i> Add TASK
                                    </button>
                                </div>
                                <!-- Tombol Submit -->
                                <div class="col-12 d-flex justify-content-start mt-3">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="<?= base_url('/dev/monitoring'); ?>" class="btn btn-danger">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--DROPDOWN & INPUT OTOMATIS SESUAI DATA DIPILIH-->
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

            // Reset dropdown project setiap kali customer berubah
            $('#project-dropdown').empty().append('<option value="">-- Select Project --</option>').prop('disabled', true);

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

<!--GENERATE FORM-->
<script>
    document.getElementById("addTaskButton").addEventListener("click", function() {
        const taskContainer = document.getElementById("taskPicContainer");

        // Ambil nilai dari form utama
        const customerId = document.getElementById("customer-dropdown").value;
        const projectId = document.getElementById("project-dropdown").value;
        const dieGo = document.getElementById("die_go").value;
        const masproDate = document.getElementById("plan_finish").value;

        if (!customerId || !projectId || !dieGo || !masproDate) {
            alert("Harap lengkapi data utama sebelum menambahkan Task PIC.");
            return;
        }

        // Template task PIC dengan tombol remove
        const newTask = document.createElement("div");
        newTask.classList.add("row", "mb-3", "task-pic-item");
        newTask.innerHTML = `
        <div class="col-md-3">
            <label>PIC</label>
            <select class="form-control" name="pic_id[]" value="<?= old('user_id'); ?>" required>
                <option value="">-- Select PIC --</option>
                <?php foreach ($users as $user): ?>
                    <option value="<?= $user['user_id']; ?>"><?= $user['nama'] . ' (' . $user['role'] . ')'; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-3">
            <label>Plan Start</label>
            <input type="date" class="form-control" name="planStart[]" value="<?= old('start_plan'); ?>" required>
        </div>
        <div class="col-md-3">
            <label>Plan Finish</label>
            <input type="date" class="form-control" name="planFinish[]" value="<?= old('finish_plan'); ?>" required>
        </div>
        <div class="col-md-3 d-flex align-items-end">
            <button type="button" class="btn btn-danger removeTaskButton">
                <i class="fa fa-trash"></i> Remove
            </button>
        </div>
    `;

        // Tambahkan ke dalam container
        taskContainer.appendChild(newTask);

        // Event listener untuk hapus task
        newTask.querySelector(".removeTaskButton").addEventListener("click", function() {
            newTask.remove();
        });
    });
</script>

<?= $this->endSection(); ?>