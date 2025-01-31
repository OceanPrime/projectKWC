<?= $this->extend('PIC/layout/template'); ?>
<?= $this->section('contentApproval'); ?>
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
                        <a href="#">Update Customer</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Update Status Task</h4>
                        </div>
                        <div class="card-body">
                            <form class="form" action="" method="post">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="model-dropdown">Plan Start/ Plan finish</label>
                                            <div class="input-group">
                                                <!-- Dropdown -->
                                                <input type="date" class="form-control" id="customer_name" name="customer_name" required>
                                                <!-- Input Manual -->
                                            </div>
                                            <div class="input-group">
                                                <!-- Dropdown -->
                                                <input type="date" class="form-control" id="customer_name" name="customer_name" required>
                                                <!-- Input Manual -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="model-dropdown">Actual Start/Actual finish</label>
                                            <div class="input-group">
                                                <!-- Dropdown -->
                                                <input type="date" class="form-control" id="customer_name" name="customer_name" required>
                                                <!-- Input Manual -->
                                            </div>
                                            <div class="input-group">
                                                <!-- Dropdown -->
                                                <input type="date" class="form-control" id="customer_name" name="customer_name" required>
                                                <!-- Input Manual -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="model-dropdown">Remark</label>
                                            <div class="input-group">
                                                <!-- Dropdown -->
                                                <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                                                <!-- Input Manual -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="status">STATUS</label>
                                            <select class="form-control" name="status" id="status" >
                                            <option selected disabled>--Pilih--</option>
                                                <option>COMPLETED</option>
                                                <option>COMPLETED DELAY</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-start">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                        <a href="/dev/costumer" class="btn btn-danger me-1 mb-1">Batal</a>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const dropdown = document.getElementById('model-dropdown');
    const customInput = document.getElementById('custom-input');

    dropdown.addEventListener('change', function() {
        if (this.value === 'custom') {
            // Tampilkan input manual
            customInput.classList.remove('d-none');
            customInput.focus();
        } else {
            // Sembunyikan input manual
            customInput.classList.add('d-none');
        }
    });

    // Saat form disubmit
    document.querySelector('form').addEventListener('submit', function() {
        // Jika input manual diisi, pindahkan nilainya ke dropdown
        if (!customInput.classList.contains('d-none') && customInput.value.trim() !== '') {
            const newOption = document.createElement('option');
            newOption.textContent = customInput.value;
            newOption.value = customInput.value;
            newOption.selected = true; // Pilih opsi ini di dropdown
            dropdown.appendChild(newOption);
        }
    });
</script>

<?= $this->endSection(); ?>