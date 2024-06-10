<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Stok Oli Gudang
                </h4>
            </div>
        </div>
    </div>

    <?php
        $role = $this->session->userdata('role');
        // Menampilkan nilai peran (role) pengguna
    ?>

    <div class="card-body">
        <div class="">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>ID Oli</th>
                        <th>Nama Oli</th>
                        <th>Supplier</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <?php if ($role == 'admin' || $role == 'finance'): ?>
                        <th>Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                $no = 1;
                if ($oli) :
                    foreach ($oli as $o) :
                        ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $o->id_oli; ?></td>
                        <td><?= $o->nama_oli; ?></td>
                        <td><?= $o->nama_supplier; ?></td>
                        <td>Rp <?= number_format($o->harga, 0, '.', ','); ?></td>
                        <td><?= $o->stok; ?> - Liter</td>
                        <?php if ($role == 'admin' || $role == 'finance'): ?>

                        <td>
                            <a href="<?= base_url('oli/edit/') . $o->id_oli; ?>"
                                class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a>

                            <a href="<?= base_url('oli/delete/') . $o->id_oli; ?>"
                                class="btn btn-danger btn-circle btn-sm delete"><i class="fa fa-trash"></i></a>
                        </td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                    <?php else : ?>
                    <tr>
                        <td colspan="7" class="text-center">
                            Data Kosong
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
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
        title: 'Hapus data oli?',
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