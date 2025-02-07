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
                        <div class="card-body">
                            <form class="form" action="" method="post">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="size">Project</label>
                                            <input type="text" id="size" class="form-control" autofocus name="size" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="size">Start Plan</label>
                                            <input type="date" id="size" class="form-control" autofocus name="size" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="size">Start Actual</label>
                                            <input type="date" id="size" class="form-control" autofocus name="size" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="size">Finish Plan</label>
                                            <input type="date" id="size" class="form-control" autofocus name="size" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="size">Finish Actual</label>
                                            <input type="date" id="size" class="form-control" autofocus name="size" value="">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="status">STATUS</label>
                                        <select class="form-control" name="status" id="status" value="">
                                            <option selected disabled>--Pilih--</option>
                                            <option value="COMPLETED">COMPLETED</option>
                                            <option value="ON PROGRESS">ON PROGRESS</option>
                                        </select>
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