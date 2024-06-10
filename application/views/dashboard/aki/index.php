<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Stok Aki Gudang
                </h4>
            </div>
        </div>
    </div>

    <?php
        $currentRole = $this->session->userdata('role');
        // Menampilkan nilai peran (role) pengguna
    ?>

    <div class="card-body">
        <div class="">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>ID Aki</th>
                        <th>Merk</th>
                        <th>Kondisi</th>
                        <th>Supplier</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <?php if ($currentRole == 'admin' || $currentRole == 'finance'): ?>
                        <th>Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($aki) :
                        $no = 1;
                        foreach ($aki as $ak) :
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $ak->id_aki; ?></td>
                        <td><?= $ak->merk; ?></td>
                        <td><?= $ak->kondisi; ?></td>
                        <td><?= $ak->nama_supplier; ?></td>
                        <td>Rp <?= number_format($ak->harga, 0, '.', ','); ?></td>
                        <td><?= $ak->stok; ?></td>
                        <?php if ($currentRole == 'admin' || $currentRole == 'finance'): ?>
                        <td>
                            <a href="<?= base_url('aki/edit/') . $ak->id_aki; ?>"
                                class="btn btn-circle btn-warning btn-sm"><i class="fa fa-edit"></i></a>

                            <a href="<?= base_url('aki/hapus/') . $ak->id_aki ?>"
                                class="btn btn-circle btn-danger btn-sm delete"><i class="fa fa-trash"></i></a>
                        </td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                    <?php else : ?>
                    <td colspan="100%" class="text-center">
                        Data Aki kosong!
                    </td>
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
        title: 'Hapus data aki?',
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
    title: "Gagl",
    text: "<?= $this->session->flashdata('error') ?>",
    icon: "error",
    button: false,
    timer: 5000,
});
<?php
        unset($_SESSION['error']);
    } ?>
</script>