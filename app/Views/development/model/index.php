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
                        <a href="#">Monitoring</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Monitoring Data</h4>
                        </div>
                        <div class="card-body">
                            <a href="<?=base_url('/dev/model-tambah'); ?>">
                                <button class="btn btn-primary rounded-pill">
                                    <i class="fa fa-plus"></i>
                                    Add Model
                                </button>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Model</th>
                                            <th>Size</th>
                                            <th>Product</th>
                                            <th>Material</th>
                                            <th>Jenis</th>
                                            <th>Status</th>
                                            <th>Die-Go</th>
                                            <th>Plan M/P</th>
                                            <th>Days Plan</th>
                                            <th>Days Act</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>MR 708</td>
                                            <td>17x8.5 H5/6</td>
                                            <td>MR 708_17x8.5 H5/6</td>
                                            <td>ALSi7</td>
                                            <td>Roda 4</td>
                                            <td>COMPLETED</td>
                                            <td>2-aug-2024</td>
                                            <td>8-Nov-2024</td>
                                            <td>102</td>
                                            <td>327</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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