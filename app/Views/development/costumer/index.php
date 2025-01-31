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
                        <a href="#">Customer</a>
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
            <?php if (session()->getFlashdata('pesan')) :?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif;?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Costumer</h4>
                        </div>
                        <div class="card-body">
                            <a href="<?=base_url('/dev/costumer-tambah'); ?>">
                                <button class="btn btn-primary rounded-pill">
                                    <i class="fa fa-plus"></i>
                                    Add Costumer
                                </button>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Customer Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($customer as $k) : ?>
                                        <tr>
                                            <td scope="row"><?= $i++; ?></td>
                                            <td><?= $k['customer_name']; ?></td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="<?= base_url('/dev/costumer-edit/' . $k['id']); ?>">
                                                        <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-simple-primary" data-original-title="Edit Task">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a href="javascript:void(0);" 
                                                        data-url="<?= base_url('/Customer/delete/' . $k['id']); ?>" 
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