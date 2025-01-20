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
                        <a href="#">Add Model</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Model</h4>
                        </div>
                        <div class="card-body">
                            <form class="form" action="/model-save" method="post">
                            <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="size">Size</label>
                                            <input type="text" id="size" class="form-control <?=($validation->hasError('size')) ? 
											'is-invalid' : '' ;?>" autofocus name="size" value="<?= old('size');?>">
                                        </div>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('size');?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="product">Product</label>
                                            <input type="text" id="product" class="form-control <?=($validation->hasError('product')) ? 
											'is-invalid' : '' ;?>" name="product" value="<?= old('product');?>">
                                        </div>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('product');?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="material">Material</label>
                                            <input type="text" id="material" class="form-control <?=($validation->hasError('material')) ? 
											'is-invalid' : '' ;?>" name="material" value="<?= old('material');?>">
                                        </div>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('material');?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="jenis">Jenis</label>
                                            <input type="text" id="jenis" class="form-control <?=($validation->hasError('jenis')) ? 
											'is-invalid' : '' ;?>" name="jenis" value="<?= old('jenis');?>">
                                        </div>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('jenis');?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="customer_id">Customer</label>
                                            <select class="form-control" id="customer_id" name="customer_id" required>
                                                <option selected disabled>--Pilih Customer--</option>
                                                <?php foreach ($customers as $customer): ?>
                                                    <option value="<?= $customer['id']; ?>">
                                                        <?= $customer['customer_name']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="die_go">DIE-GO</label>
                                            <input type="date" id="die_go" class="form-control <?=($validation->hasError('die_go')) ? 
											'is-invalid' : '' ;?>" name="die_go" value="<?= old('die_go');?>">
                                        </div>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('die_go');?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="model_name">Model</label>
                                            <input type="text" id="model_name" class="form-control <?=($validation->hasError('model_name')) ? 
											'is-invalid' : '' ;?>" name="model_name" value="<?= old('model_name');?>">
                                        </div>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('model_name');?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="plan_mp">PLAN M/P</label>
                                            <input type="date" id="plan_mp" class="form-control <?=($validation->hasError('plan_mp')) ? 
											'is-invalid' : '' ;?>"  name="plan_mp" value="<?= old('plan_mp');?>">
                                        </div>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('plan_mp');?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="status">STATUS</label>
                                            <select class="form-control <?=($validation->hasError('status')) ? 
											'is-invalid' : '' ;?>" name="status" id="status" >
                                            <option selected disabled>--Pilih--</option>
                                                <option>COMPLETED</option>
                                                <option>ON PROGRESS</option>
                                            </select>
                                        </div>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('status');?>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-start">
                                        <button type="submit"
                                            class="btn btn-primary me-1 mb-1">Submit</button>
                                        <a href="<?=base_url('/dev/model'); ?>" class="btn btn-danger me-1 mb-1">
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
    <footer class="footer">
        <div class="container-fluid">
            <nav class="pull-left">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="https://www.themekita.com">
                            ThemeKita
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Help
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Licenses
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="copyright ml-auto">
                2018, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://www.themekita.com">ThemeKita</a>
            </div>
        </div>
    </footer>
</div>
<?= $this->endSection(); ?>