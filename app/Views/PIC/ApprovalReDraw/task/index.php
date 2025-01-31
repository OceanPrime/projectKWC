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
                                            <th>Plan M/P</th>
                                            <th>Days Plan</th>
                                            <th>Days Act</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Mobil</td>
                                            <td>Raven</td>
                                            <td>10cm</td>
                                            <td>Japan</td>
                                            <td>Besi</td>
                                            <td>Roda 4</td>
                                            <td>ON - PROGRESS</td>
                                            <td>15 januari 2025</td>
                                            <td>20 maret 2026</td>
                                            <td>10</td>
                                            <td>11</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="<?= base_url('/PIC/ApprovalRedraw-edit') ?>">
                                                        <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-simple-primary" data-original-title="Edit Task">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
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
</div>
<?= $this->endSection(); ?>