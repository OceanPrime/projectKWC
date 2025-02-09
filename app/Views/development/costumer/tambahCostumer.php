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
                        <a href="#">Add costumer</a>
                    </li>
                </ul>
            </div>
            <?php if (session()->getFlashdata('error_validation')): ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('error_validation') ?>
                            </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add costumer</h4>
                        </div>
                        <div class="card-body">
                        <form class="form" action="/Customer-save" method="POST" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="model-dropdown">Customer</label>
                                        <div class="input-group">
                                            <!-- Dropdown -->
                                            <select name="customer_name" class="form-control <?= ($validation->hasError('customer_name')) ? 'is-invalid' : ''; ?>" id="model-dropdown">
                                                <option selected disabled>--Pilih--</option>
                                                <option value="CWH">CWH</option>
                                                <option value="Customer">Customer</option>
                                                <option value="custom">Tambah Manual...</option>
                                            </select>
                                            
                                            <!-- Input Manual -->
                                            <input type="text" name="customer_name_custom" class="form-control d-none" id="custom-input" placeholder="Masukkan Customer baru">
                                        </div>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('customer_name'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-start">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
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

    dropdown.addEventListener('change', function () {
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
    document.querySelector('form').addEventListener('submit', function () {
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