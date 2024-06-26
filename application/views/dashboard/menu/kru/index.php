<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Daftar Kru
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('kru/tambah') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Tambah Kru
                    </span>
                </a>
            </div>
        </div>
    </div>

    <?php
        $currentRole = $this->session->userdata('role');
        // Menampilkan nilai peran (role) pengguna
    ?>

    <div class="table-responsive">
        <table class="table table-striped" id="dataTable">
            <thead>
                <tr>
                    <th>No. </th>
                    <th>Nama Kru</th>
                    <?php if ($currentRole == 'admin' || $currentRole == 'finance'): ?>
                    <th>Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($crew) :
                    foreach ($crew as $c) :
                        ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $c['nama_crew']; ?></td>

                    <?php if ($currentRole == 'admin' || $currentRole == 'finance'): ?>
                    <td>
                        <a href="<?= base_url('kru/edit/') . $c['id_crew']; ?>"
                            class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a>

                        <a href="<?= base_url('kru/delete/') . $c['id_crew']; ?>"
                            class="btn btn-danger btn-circle btn-sm delete"><i class="fa fa-trash"></i></a>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
                <?php else : ?>
                <tr>
                    <td colspan="3" class="text-center">
                        Data Kosong
                    </td>
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
        title: 'Hapus data jenis?',
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