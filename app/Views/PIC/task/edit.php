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
                        <a href="#">Task</a>
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
                            <h4 class="card-title">Update Status Task</h4>
                        </div>
                        <div class="card-body">
                        <?php 
                            $isDisabled = false; // Default: input aktif
                            if (isset($prevTask) && empty($prevTask['finish_actual'])) {
                                $isDisabled = true; // Nonaktifkan input jika role sebelumnya belum menyelesaikan task
                            }
                        ?>

                        <form class="form" action="/PIC/update-task/<?= esc($task['id']); ?>" method="post">
                            <?= csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="start_plan">Plan Start</label>
                                        <input type="date" class="form-control" id="start_plan" name="start_plan" value="<?= esc($task['start_plan']); ?>" readonly>

                                        <label for="finish_plan">Plan Finish</label>
                                        <input type="date" class="form-control" id="finish_plan" name="finish_plan" value="<?= esc($task['finish_plan']); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="start_actual">Actual Start</label>
                                        <input type="date" class="form-control" id="start_actual" name="start_actual" value="<?= esc($task['start_actual']); ?>" <?= $isDisabled ? 'disabled' : 'required'; ?>>

                                        <label for="finish_actual">Actual Finish</label>
                                        <input type="date" class="form-control" id="finish_actual" name="finish_actual" value="<?= esc($task['finish_actual']); ?>" <?= $isDisabled ? 'disabled' : 'required'; ?>>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="remark">Remark</label>
                                        <input type="text" class="form-control" id="remark" name="remark" value="<?= esc($task['remark']); ?>" <?= $isDisabled ? 'disabled' : 'required'; ?>>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="status">STATUS</label>
                                        <input type="text" class="form-control" id="status" name="status" value="<?= esc($task['status']); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="gap_sd">GAP S.D (Days)</label>
                                        <input type="text" class="form-control" id="gap_sd" name="gap_sd" value="<?= esc($gapSD); ?>" readonly>

                                        <label for="gap_fd">GAP F.D (Days)</label>
                                        <input type="text" class="form-control" id="gap_fd" name="gap_fd" value="<?= esc($gapFD); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-start">
                                    <button type="submit" class="btn btn-primary me-1 mb-1" <?= $isDisabled ? 'disabled' : ''; ?>>Update</button>
                                    <a href="/PIC/TASK" class="btn btn-danger me-1 mb-1">Batal</a>
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