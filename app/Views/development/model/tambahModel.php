<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Project KWC</h4>
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
                            <form class="form" action="">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="name">Size</label>
                                            <input type="text" id="name" class="form-control"
                                                placeholder="" name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="local-address">Product</label>
                                            <input type="text" id="local-address" class="form-control"
                                                placeholder="" name="local-address">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="local-address">Material</label>
                                            <input type="text" id="local-address" class="form-control"
                                                placeholder="" name="local-address">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="local-address">Jenis</label>
                                            <input type="text" id="local-address" class="form-control"
                                                placeholder="" name="local-address">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="remote-address">Model</label>
                                            <select class="form-control form-control" id="defaultSelect">
                                                <option selected disabled>--Pilih--</option>
                                                <option>MM1025</option>
                                                <option>EVO 001</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="local-address">DIE-GO</label>
                                            <input type="date" id="local-address" class="form-control"
                                                placeholder="" name="local-address">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="local-address">PLAN M/P</label>
                                            <input type="date" id="local-address" class="form-control"
                                                placeholder="" name="local-address">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="remote-address">STATUS</label>
                                            <select class="form-control form-control" id="defaultSelect">
                                            <option selected disabled>--Pilih--</option>
                                                <option>COMPLETED</option>
                                                <option>ON PROGRESS</option>
                                            </select>
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