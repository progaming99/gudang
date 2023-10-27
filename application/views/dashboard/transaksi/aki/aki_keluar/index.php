<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Riwayat Data Aki Keluar
                </h4>
            </div>

            <div class="col-auto">
                <a href="<?= base_url('aki_keluar/tambah') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Input Aki Keluar
                    </span>
                </a>
            </div>
        </div>
    </div>

    <?php
        $role = $this->session->userdata('role');
        // Menampilkan nilai peran (role) pengguna
    ?>

    <div class="table-responsive">
        <table class="table table-striped w-100 dt-responsive" id="dataTable" scrollX="true" scrollY="400">
            <thead>
                <tr>
                    <th>No. </th>
                    <th>No Transaksi</th>
                    <th>Tanggal Keluar</th>
                    <th>Merk</th>
                    <th>Jumlah Keluar</th>
                    <th>Armada</th>
                    <th>Supir</th>
                    <th>Montir</th>
                    <th>Tanggal Pasang Baru</th>
                    <th>Tanggal Pasang Lama</th>
                    <th>Lama Pemakaian Hari</th>
                    <th>Lama Pemakaian Tahun</th>
                    <!-- <th>Masalah</th>
                    <th>Keterangan</th> -->
                    <th>User</th>
                    <?php if ($role == 'admin' || $role == 'finance'): ?>
                    <th>Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>

            <tbody>
                <?php
                $no = 1;
                if ($aki_keluar) :
                    foreach ($aki_keluar as $ak) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $ak['id_aki_keluar']; ?></td>
                    <td><?= date('d/m/Y', strtotime($ak['tanggal_keluar'])); ?></td>
                    <td><?= $ak['merk']; ?></td>
                    <td><?= $ak['jumlah_keluar']; ?></td>
                    <td><?= $ak['nama_armada']; ?></td>
                    <td><?= $ak['nama_supir']; ?></td>
                    <td><?= $ak['nama_montir']; ?></td>
                    <td><?= date('d/m/Y', strtotime($ak['tgl_pasang_baru'])); ?></td>
                    <td><?= date('d/m/Y', strtotime($ak['tgl_pasang_lama'])); ?></td>
                    <td><?= $ak['lama_pemakaian_hari']; ?></td>
                    <td><?= $ak['lama_pemakaian_tahun']; ?></td>
                    <!-- <td><?= $ak['masalah']; ?></td>
                    <td><?= $ak['keterangan']; ?></td> -->
                    <td><?= $ak['nama']; ?></td>

                    <!-- Kondisi untuk tombol hapus -->
                    <?php if ($role == 'admin' || $role == 'finance'): ?>
                    <td>
                        <a href="<?= base_url('aki_keluar/delete/') . $ak['id_aki_keluar'] ?>"
                            class="btn btn-circle btn-danger btn-sm delete"><i class="fa fa-trash"></i></a>
                    </td>
                    <?php endif; ?>

                </tr>
                <?php endforeach; ?>
                <?php else : ?>
                <tr>
                    <td colspan="100%" class="text-center">
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
        title: 'Hapus data?',
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