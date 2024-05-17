<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Laporan Perbaikan Armada Belum Selesai
                </h4>
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

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered small-font" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Armada</th>
                        <th>Jenis Kerusakan</th>
                        <th>Tanggal Masuk Bengkel</th>
                        <th>PIC Montir 1</th>
                        <th>PIC Montir 2</th>
                        <th>Level Kebutuhan</th>
                        <th>Tindakan Hari Ini</th>
                        <th>Berapa Langkah</th>
                        <th>Masalah</th>
                        <th>Rencana Selesai</th>
                        <th>User</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                $no = 1;
                if ($lap_perbaikan) :
                    foreach ($lap_perbaikan as $pbk) :
                // Add a check for the "Belum Selesai" status
                if ($pbk->status == 'Belum Selesai') :
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $pbk->nama_armada; ?></td>
                        <td><?= $pbk->jenis_kerusakan; ?></td>
                        <td><?= $pbk->tgl_masuk; ?></td>
                        <td><?= $pbk->montir_1; ?></td>
                        <td><?= $pbk->montir_2; ?></td>
                        <td><?= $pbk->nama_level; ?></td>
                        <td><?= $pbk->progress; ?></td>
                        <td><?= $pbk->tahapan; ?></td>
                        <td><?= $pbk->masalah; ?></td>
                        <td><?= $pbk->rencana_selesai; ?></td>
                        <td><?= $pbk->nama; ?></td>
                    </tr>

                    <?php
            endif;
        endforeach;
    else :
    ?>
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

    window.location.href = `perbaikan?start_date=${startDate}&end_date=${endDate}`;
}

function resetFilter() {
    window.location.href = 'perbaikan'
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
        title: 'Hapus Data Perbaikan?',
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