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
                        <a href="#">Update Model</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Update Model</h4>
                        </div>
                        <div class="card-body">
                            <form class="form" action="<?= base_url('/dev/model-update/' . $model['id']) ?>" method="post">
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="size">Size</label>
                                            <input type="text" id="size" class="form-control" autofocus name="size" value="<?= $model['size'] ?? '' ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="product">Product</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="material">Material</label>
                                            <input type="text" id="material" class="form-control" name="material" value="">
                                        </div>

                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="jenis">Jenis</label>
                                            <input type="text" id="jenis" class="form-control" name="jenis" value="">
                                        </div>

                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="customer_id">Customer</label>
                                            <select class="form-control" id="customer_id" name="customer_id" required>
                                                <?php foreach ($customers as $customer): ?>
                                                    <option value="<?= $customer['id'] ?>" <?= ($customer['id'] == $model['customer_id']) ? 'selected' : '' ?>>
                                                        <?= $customer['customer_name'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="die_go">DIE-GO</label>
                                            <input type="date" id="die_go" class="form-control" name="die_go" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="model_name">Model</label>
                                            <input type="text" id="model_name" class="form-control" name="model_name" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="plan_mp">PLAN M/P</label>
                                            <input type="date" id="plan_mp" class="form-control" name="plan_mp" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="plan_finish">PLAN FINISH</label>
                                            <input type="date" id="plan_finish" class="form-control" name="plan_finish" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="status">STATUS</label>
                                            <select class="form-control" name="status" id="status">
                                                <option selected disabled>--Pilih--</option>
                                                <option value="COMPLETED" <?= ($model['status'] === 'COMPLETED') ? 'selected' : '' ?>>COMPLETED</option>
                                                <option value="ON PROGRESS" <?= ($model['status'] === 'ON PROGRESS') ? 'selected' : '' ?>>ON PROGRESS</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-start">
                                        <button type="submit"
                                            class="btn btn-primary me-1 mb-1">Update</button>
                                        <a href="<?= base_url('/dev/model'); ?>" class="btn btn-danger me-1 mb-1">
                                            Cancel
                                        </a>
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
<?= $this->endSection(); ?>