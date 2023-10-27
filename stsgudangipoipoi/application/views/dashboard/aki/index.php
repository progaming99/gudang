<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Aki
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('Aki/tambah'); ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Tambah Aki
                    </span>
                </a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nomor Armada</th>
                        <th>Nama Supir</th>
                        <th>Tanggal Pasang Baru</th>
                        <th>Lama Pemakaian Hari</th>
                        <th>Aksi</th>
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
                        <td><?= $ak->nomor_armada; ?></td>
                        <td><?= $ak->nama_supir; ?></td>
                        <td><?= date('d F Y',strtotime("$ak->tanggal_pasang_baru")); ?></td>
                        <td><?= $ak->lama_pemakaian_hari; ?></td>
                        <td>
                            <a href="<?= base_url('Aki/detail/') . $ak->id_aki; ?>"
                                class="btn btn-circle btn-primary btn-sm"><i class="fa fa-info"></i></a>

                            <a href="<?= base_url('Aki/edit/') . $ak->id_aki; ?>"
                                class="btn btn-circle btn-warning btn-sm"><i class="fa fa-edit"></i></a>

                            <a href="<?= base_url('Aki/hapus/') . $ak->id_aki ?>"
                                class="btn btn-circle btn-danger btn-sm delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else : ?>
                    <td colspan="9" class="text-center">
                        Data ban kosong!
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