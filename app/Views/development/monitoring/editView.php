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
                        <a href="#">View Project</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Update Project</h4>
                        </div>
                        <?php if (session()->getFlashdata('error_validation')): ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('error_validation') ?>
                            </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <form class="form" action="<?= base_url('/dev/monitoring-updateView/' . $view['id']) ?>" method="post">
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="task_name">Role</label>
                                            <select class="form-control form-control" id="task_name" name="task_name">
                                                <option selected disabled>--Pilih--</option>
                                                <option value="ReDrawing" <?= $view['task_name'] == 'ReDrawing' ? 'selected' : ''; ?>>ReDrawing</option>
                                                <option value="ApprovalReDraw" <?= $view['task_name'] == 'ApprovalReDraw' ? 'selected' : ''; ?>>Approval ReDraw</option>
                                                <option value="DevelopmentSchedule" <?= $view['task_name'] == 'DevelopmentSchedule' ? 'selected' : ''; ?>>Development Schedule</option>
                                                <option value="MoldManufacture" <?= $view['task_name'] == 'MoldManufacture' ? 'selected' : ''; ?>>Mold Manufacture</option>
                                                <option value="MoldShipment" <?= $view['task_name'] == 'MoldShipment' ? 'selected' : ''; ?>>Mold Shipment</option>
                                                <option value="MoldArrival" <?= $view['task_name'] == 'MoldArrival' ? 'selected' : ''; ?>>Mold Arrival</option>
                                                <option value="DevelopmentBox" <?= $view['task_name'] == 'DevelopmentBox' ? 'selected' : ''; ?>>DevelopmentBox</option>
                                                <option value="DevelopCap" <?= $view['task_name'] == 'DevelopCap' ? 'selected' : ''; ?>>DevelopCap</option>
                                                <option value="MoldAssy" <?= $view['task_name'] == 'MoldAssy' ? 'selected' : ''; ?>>Mold Assy</option>
                                                <option value="TrialCasting" <?= $view['task_name'] == 'TrialCasting' ? 'selected' : ''; ?>>Trial Casting</option>
                                                <option value="Machining" <?= $view['task_name'] == 'Machining' ? 'selected' : ''; ?>>Machining</option>
                                                <option value="Painting" <?= $view['task_name'] == 'Painting' ? 'selected' : ''; ?>>Painting</option>
                                                <option value="TestImpact" <?= $view['task_name'] == 'TestImpact' ? 'selected' : ''; ?>>Test Impact</option>
                                                <option value="TestBending" <?= $view['task_name'] == 'TestBending' ? 'selected' : ''; ?>>Test Bending</option>
                                                <option value="TestRadial" <?= $view['task_name'] == 'TestRadial' ? 'selected' : ''; ?>>Test Radial</option>
                                                <option value="Packing&Delivery" <?= $view['task_name'] == 'Packing&Delivery' ? 'selected' : ''; ?>>Packing & Delivery</option>
                                            </select>
                                        </div>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('task_name'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="start_plan">Start Plan</label>
                                            <input type="date" id="start_plan" class="form-control"  name="start_plan" value="<?= $view['start_plan'] ?? '' ?>">
                                        </div>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('start_plan'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="start_actual">Start Actual</label>
                                            <input type="date" id="start_actual" class="form-control"  name="start_actual" value="<?= $view['start_actual'] ?? '' ?>">
                                        </div>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('start_actual'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="finish_plan">Finish Plan</label>
                                            <input type="date" id="finish_plan" class="form-control"  name="finish_plan" value="<?= $view['finish_plan'] ?? '' ?>">
                                        </div>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('finish_plan'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="finish_actual">Finish Actual</label>
                                            <input type="date" id="finish_actual" class="form-control"  name="finish_actual" value="<?= $view['finish_actual'] ?? '' ?>">
                                        </div>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('finish_actual'); ?>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="status">STATUS</label>
                                        <select class="form-control" name="status" id="status">
                                            <option disabled>--Pilih--</option>
                                            <option value="COMPLETED" <?= ($view['status'] == 'COMPLETED') ? 'selected' : ''; ?>>COMPLETED</option>
                                            <option value="ON PROGRESS" <?= ($view['status'] == 'ON PROGRESS') ? 'selected' : ''; ?>>ON PROGRESS</option>
                                            <option value="PENDING" <?= ($view['status'] == 'PENDING') ? 'selected' : ''; ?>>PENDING</option>
                                        </select>
                                    </div>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('status'); ?>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-start">
                                    <button type="submit"
                                        class="btn btn-primary me-1 mb-1">Update</button>
                                    <a href="<?= base_url('/dev/monitoring-view'); ?>" class="btn btn-danger me-1 mb-1">
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