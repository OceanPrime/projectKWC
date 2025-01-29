<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Project KCC</h4>
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
                        <a href="#">Manajemen PIC</a>
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
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Akun PIC</h4>
                        </div>
                        <div class="card-body">
                            <a href="<?= base_url('/dev/tambahPIC'); ?>">
                                <button class="btn btn-primary rounded-pill">
                                    <i class="fa fa-plus"></i>
                                    Add PIC
                                </button>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Username</th>
                                
                                            <th>No. Handphone</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                        <?php $i = 1; ?>
                                        <?php foreach ($Usermodel as $k) : ?>
                                        <tr>
                                            <td scope="row"><?= $i++; ?></td>
                                            <td><?= $k['nama']; ?></td>
                                            <td><?= $k['username']; ?></td>
                                            <td><?= $k['no_hp']; ?></td>
                                            <td><?= $k['role']; ?></td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="<?= base_url('/dev/editPIC/' . $k['user_id']); ?>">
                                                        <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-simple-primary" data-original-title="Edit Task">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a href="javascript:void(0);" 
                                                        data-url="<?= base_url('/account/delete/' . $k['user_id']); ?>" 
                                                        class="btn btn-link btn-simple-danger delete-button" 
                                                        data-toggle="tooltip" 
                                                        title="Hapus Data">
                                                        <i class="fa fa-trash"></i>
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
<script>
    // Tangkap event klik pada tombol dengan class `delete-button`
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-button');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const deleteUrl = this.getAttribute('data-url'); // Ambil URL dari atribut data-url

                Swal.fire({
                    title: 'Apakah yakin ingin menghapus data ini?',
                    text: "Data yang sudah dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect ke URL penghapusan
                        window.location.href = deleteUrl;
                    }
                });
            });
        });
    });
</script>
<?= $this->endSection(); ?>