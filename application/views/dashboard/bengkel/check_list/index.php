<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Check List Perbaikan
                </h4>
            </div>

            <div class="col-auto">
                <a href="<?= base_url('check_list/tambah'); ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Tambah Check List
                    </span>
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

    <table class="table-responsive table-striped w-100 dt-responsive nowrap small-font" id="dataTable">
        <thead>
            <tr>
                <th>No. </th>
                <th>Tanggal</th>
                <th>Armada</th>
                <th>Supir</th>
                <th>Kernet</th>
                <th>Kebersihan</th>
                <th>Kelayakan Box 4 Sisi</th>
                <th>Tekanan Ban Depan</th>
                <th>Tekanan Ban Belakang 1</th>
                <th>Tekanan Ban Belakang 2</th>
                <th>Lampu Utama</th>
                <th>Lampu Aksesoris</th>
                <th>Lampu Sein</th>
                <th>Oli</th>
                <th>Aki</th>
                <th>Kelayakan Ban</th>
                <th>Kelayakan Armada</th>
                <th>Catatan</th>
                <th>User</th>
                <?php if ($role == 'admin' || $role == 'finance'): ?>
                <th>Aksi</th>
                <?php endif; ?>
            </tr>
        </thead>

        <tbody>
            <?php
                $no = 1;
                if ($check_list) :
                    foreach ($check_list as $cl) :
                ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $cl->tanggal; ?></td>
                <td><?= $cl->nama_armada; ?></td>
                <td><?= $cl->nama_supir; ?></td>
                <td><?= $cl->nama_kernet; ?></td>
                <td><?= $cl->kebersihan_armada; ?></td>
                <td><?= $cl->kelayakan_box; ?></td>
                <td><?= $cl->tekanan_ban_depan; ?></td>
                <td><?= $cl->tekanan_ban_belakang_1; ?></td>
                <td><?= $cl->tekanan_ban_belakang_2; ?></td>
                <td><?= $cl->lampu_utama; ?></td>
                <td><?= $cl->lampu_kota; ?></td>
                <td><?= $cl->lampu_sein; ?></td>
                <td><?= $cl->level_oli; ?></td>
                <td><?= $cl->level_aki; ?></td>
                <td><?= $cl->kelayakan_ban; ?></td>
                <td><?= $cl->kelayakan; ?></td>
                <td><?= $cl->catatan; ?></td>
                <td><?= $cl->nama; ?></td>
                <?php if ($role == 'admin' || $role == 'finance'): ?>
                <td>
                    <a href="<?= base_url('check_list/edit/') . $cl->id_check_list; ?>"
                        class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a>

                    <a href="<?= base_url('check_list/delete/') . $cl->id_check_list; ?>"
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

    <style>
    .small-font {
        font-size: 10px;
        /* Sesuaikan dengan ukuran font yang diinginkan */
    }
    </style>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
    crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function filter() {
    const startDate = $("#startDate").val();
    const endDate = $("#endDate").val();

    window.location.href = `check_list?start_date=${startDate}&end_date=${endDate}`;
}

function resetFilter() {
    window.location.href = 'check_list'
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
        title: 'Hapus Check List?',
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