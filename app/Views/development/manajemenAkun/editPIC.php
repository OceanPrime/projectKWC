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
                        <a href="#">Edit Akun PIC</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit PIC</h4>
                        </div>
                        <?php if (session()->getFlashdata('error_validation')): ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('error_validation') ?>
                            </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <form class="form" action="<?= base_url('dev/updatePIC/' . $user['user_id']); ?>" method="post">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" id="nama" class="form-control" autofocus name="nama" value="<?= $user['nama']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="hidden" name="user_id" value="<?= $user['user_id']; ?>">
                                            <input type="text" id="username" class="form-control" name="username" value="<?= $user['username']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="password">Password (biarkan kosong jika tidak ingin mengubah)</label>
                                            <input type="password" id="password" class="form-control" name="password">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="no_hp">No Handphone</label>
                                            <input type="text" id="no_hp" class="form-control" name="no_hp" value="<?= $user['no_hp']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="role">Role</label>
                                            <select class="form-control form-control" id="role" name="role">
                                                <option selected disabled>--Pilih--</option>
                                                <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                                                <option value="ReDrawing" <?= $user['role'] == 'ReDrawing' ? 'selected' : ''; ?>>ReDrawing</option>
                                                <option value="ApprovalReDraw" <?= $user['role'] == 'ApprovalReDraw' ? 'selected' : ''; ?>>Approval ReDraw</option>
                                                <option value="DevelopmentSchedule" <?= $user['role'] == 'DevelopmentSchedule' ? 'selected' : ''; ?>>Development Schedule</option>
                                                <option value="MoldManufacture" <?= $user['role'] == 'MoldManufacture' ? 'selected' : ''; ?>>Mold Manufacture</option>
                                                <option value="MoldShipment" <?= $user['role'] == 'MoldShipment' ? 'selected' : ''; ?>>Mold Shipment</option>
                                                <option value="MoldArrival" <?= $user['role'] == 'MoldArrival' ? 'selected' : ''; ?>>Mold Arrival</option>
                                                <option value="DevelopmentBox" <?= $user['role'] == 'DevelopmentBox' ? 'selected' : ''; ?>>DevelopmentBox</option>
                                                <option value="DevelopCap" <?= $user['role'] == 'DevelopCap' ? 'selected' : ''; ?>>DevelopCap</option>
                                                <option value="MoldAssy" <?= $user['role'] == 'MoldAssy' ? 'selected' : ''; ?>>Mold Assy</option>
                                                <option value="TrialCasting" <?= $user['role'] == 'TrialCasting' ? 'selected' : ''; ?>>Trial Casting</option>
                                                <option value="Machining" <?= $user['role'] == 'Machining' ? 'selected' : ''; ?>>Machining</option>
                                                <option value="Painting" <?= $user['role'] == 'Painting' ? 'selected' : ''; ?>>Painting</option>
                                                <option value="TestImpact" <?= $user['role'] == 'TestImpact' ? 'selected' : ''; ?>>Test Impact</option>
                                                <option value="TestBending" <?= $user['role'] == 'TestBending' ? 'selected' : ''; ?>>Test Bending</option>
                                                <option value="TestRadial" <?= $user['role'] == 'TestRadial' ? 'selected' : ''; ?>>Test Radial</option>
                                                <option value="Packing&Delivery" <?= $user['role'] == 'Packing&Delivery' ? 'selected' : ''; ?>>Packing & Delivery</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-start">
                                        <button type="submit"
                                            class="btn btn-primary me-1 mb-1">Update</button>
                                        <a href="<?= base_url('dev/manajemenPIC'); ?>" class="btn btn-danger me-1 mb-1">
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