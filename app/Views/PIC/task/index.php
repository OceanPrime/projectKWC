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
                        <a href="#">TASK <?= session()->get('role'); ?></a>
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
                            <h4 class="card-title">TASK <?= session()->get('role'); ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Model</th>
                                            <th>Customer Name</th>
                                            <th>Size</th>
                                            <th>Product</th>
                                            <th>Material</th>
                                            <th>Jenis</th>
                                            <th>Status</th>
                                            <th>Die-Go</th>
                                            <th>Plan Start/Finish</th>
                                            <th>Days Plan</th>
                                            <th>Remark</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($monitoring as $k) : ?>
                                            <tr>
                                                <td scope="row"><?= $i++; ?></td>
                                                <td><?= $k['model_name']; ?></td>
                                                <td><?= $k['customer_name']; ?></td>
                                                <td><?= $k['size']; ?></td>
                                                <td><?= $k['product']; ?></td>
                                                <td><?= $k['material']; ?></td>
                                                <td><?= $k['jenis']; ?></td>
                                                <td><?= $k['status']; ?></td>
                                                <td><?= $k['die_go']; ?></td>
                                                <td><?= $k['start_plan']; ?> / <?= $k['finish_plan']; ?></td>
                                                <td><?= $k['leap_time_planning']; ?></td>
                                                <td><?= $k['remark']; ?></td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="/PIC/edit-task/<?= $k['id']; ?>">
                                                            <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-simple-primary" data-original-title="Edit Task">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>