<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Laporan Oli
                </h4>
            </div>

            <div class="col-auto">
                <a href="<?= base_url('laporan/tambah_oli') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Input Laporan
                </a>
            </div>
        </div>
    </div>

    <!-- Filter Tanggal -->
    <div class="row p-3">
        <div class="col-md-3">
            <div class="form-group">
                <label for="startDate">Start Date:</label>
                <input type="date" id="startDate" name="startDate" class="form-control"
                    value="<?= $this->input->get('start_date') ?? date('Y-m-d'); ?>" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="endDate">End Date:</label>
                <input type="date" id="endDate" name="endDate" class="form-control"
                    value="<?= $this->input->get('end_date') ?? date('Y-m-d'); ?>" />
            </div>
        </div>
        <div class="col-md-3 d-flex align-items-end">
            <div class="form-group">
                <button onclick="filter()" class="btn btn-success">Filter</button>
                <button onclick="resetFilter()" class="btn btn-secondary">Reset</button>
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
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Keluar</th>
                    <th>Jenis Oli</th>
                    <th>Jumlah Keluar</th>
                    <th>Armada</th>
                    <th>User</th>
                    <?php if ($role == 'admin' || $role == 'finance'): ?>
                    <th>Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>

            <tbody>
                <?php
                $no = 1;
                if ($cetakOli) :
                    foreach ($cetakOli as $ak) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $ak['id_oli_keluar']; ?></td>
                    <td><?= date('d/m/Y', strtotime($ak['tanggal_masuk'])); ?></td>
                    <td><?= date('d/m/Y', strtotime($ak['tanggal_keluar'])); ?></td>
                    <td><?= $ak['nama_oli']; ?></td>
                    <td><?= $ak['jumlah_keluar']; ?> Liter</td>
                    <td><?= $ak['nama_armada']; ?></td>
                    <td><?= $ak['nama']; ?></td>
                    <!-- Kondisi untuk tombol hapus -->
                    <?php if ($role == 'admin' || $role == 'finance'): ?>
                    <td>
                        <a href="<?= base_url('oli_keluar/delete/') . $ak['id_oli_keluar'] ?>"
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
function filter() {
    const startDate = $("#startDate").val();
    const endDate = $("#endDate").val();

    window.location.href = "<?= base_url('laporan/cetak_laporan_oli'); ?>" + `?start_date=${startDate}&end_date=${endDate}`;
}

function resetFilter() {
    window.location.href = "<?= base_url('laporan/cetak_laporan_oli'); ?>"
}
</script>

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
