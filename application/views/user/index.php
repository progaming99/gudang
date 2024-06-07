<div class="card shadow-sm mb-4 border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data User
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('User/tambah') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-user-plus"></i>
                    </span>
                    <span class="text">
                        Tambah User
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped dt-responsive nowrap" id="dataTable">
            <thead>
                <tr>
                    <th width="30">No.</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <!-- <th>Email</th> -->
                    <th>No. telp</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($users) :
                    foreach ($users as $user) :
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td>
                        <img width="30" src="<?= base_url() ?>assets/img/avatar/<?= $user['foto'] ?>"
                            alt="<?= $user['nama']; ?>" class="img-thumbnail rounded-circle">
                    </td>
                    <td><?= $user['nama']; ?></td>
                    <td><?= $user['username']; ?></td>
                    <!-- <td><?= $user['email']; ?></td> -->
                    <td><?= $user['no_telp']; ?></td>
                    <td><?= $user['role']; ?></td>
                    <td>
                        <a href="<?= base_url('user/toggle/') . $user['id_user'] ?>"
                            class="btn btn-circle btn-sm <?= $user['is_active'] ? 'btn-secondary' : 'btn-success' ?>"
                            title="<?= $user['is_active'] ? 'Nonaktifkan User' : 'Aktifkan User' ?>"><i
                                class="fa fa-fw fa-power-off"></i></a>

                        <a href="<?= base_url('user/edit/') . $user['id_user'] ?>"
                            class="btn btn-circle btn-sm btn-warning"><i class="fa fa-fw fa-edit"></i></a>

                        <a href="<?= base_url('user/delete/') . $user['id_user'] ?>"
                            class="btn btn-circle btn-danger btn-sm delete"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach;
                else : ?>
                <tr>
                    <td colspan="8" class="text-center">Tidak Ada User!</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
    crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
<?php
    if ($this->session->flashdata('flash')) { ?>
var isi = <?php echo json_encode($this->session->flashdata('flash')) ?>;
Swal.fire({
    title: "Selamat",
    text: "<?= $this->session->flashdata('flash') ?>",
    icon: "success",
    button: false,
    timer: 5000,
});
<?php
        unset($_SESSION['flash']);
    } ?>

//tombol hapus
$('.delete').on('click', function(e) {
    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Hapus user?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Iya'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    })
})

<?php
    if ($this->session->flashdata('error')) { ?>
var isi = <?php echo json_encode($this->session->flashdata('error')) ?>;
Swal.fire({
    title: "Gagal",
    text: "<?= $this->session->flashdata('error') ?>",
    icon: "error",
    button: false,
    timer: 5000,
});
<?php
        unset($_SESSION['error']);
    } ?>
</script>