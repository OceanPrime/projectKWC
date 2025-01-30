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
                        <a href="#">Add Akun PIC</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add PIC</h4>
                        </div>
                        <?php if (session()->getFlashdata('error_validation')): ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('error_validation') ?>
                            </div>
                        <?php endif; ?>

                        <div class="card-body">
                            <form class="form" action="/PIC-save" method="post">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" id="nama" class="form-control" autofocus name="nama" value="<?= old('nama');?>" placeholder="Masukkan Nama Anda">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" id="username" class="form-control" name="username" value="<?= old('username');?>" placeholder="Masukkan Username Anda">
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" id="password" class="form-control " name="password" value="<?= old('password');?>" placeholder="Masukkan Password Anda">
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="no_hp">No Handphone</label>
                                            <input type="text" id="no_hp" class="form-control" name="no_hp" value="<?= old('no_hp');?>" placeholder="Masukkan No Handphone Anda">
                                           
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="remote-address">Role</label>
                                            <select class="form-control" id="role" name="role">
                                                <option selected disabled>--Pilih--</option>
                                                <option value="ReDrawing">ReDrawing</option>
                                                <option value="ApprovalReDraw">Approval ReDraw</option>
                                                <option value="DevelopmentSchedule">Development Schedule</option>
                                                <option value="MoldManufacture">Mold Manufacture</option>
                                                <option value="MoldShipment">Mold Shipment</option>
                                                <option value="MoldArrival">Mold Arrival</option>
                                                <option value="DevelopmentBox">DevelopmentBox</option>
                                                <option value="DevelopCap">DevelopCap</option>
                                                <option value="MoldAssy">Mold Assy</option>
                                                <option value="TrialCasting">Trial Casting</option>
                                                <option value="Machining">Machining</option>
                                                <option value="Painting">Painting</option>
                                                <option value="TestImpact">Test Impact</option>
                                                <option value="TestBending">Test Bending</option>
                                                <option value="TestRadial">Test Radial</option>
                                                <option value="Packing&Delivery">Packing & Delivery</option>
                                            </select>
                                        
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-start">
                                        <button type="submit"
                                            class="btn btn-primary me-1 mb-1">Submit</button>
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
</div>
<?= $this->endSection(); ?>