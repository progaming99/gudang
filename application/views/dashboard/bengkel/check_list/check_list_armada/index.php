<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Check List Armada
                </h4>
            </div>

            <div class="col-auto">
                <a href="<?= base_url('check_list_armada/tambah'); ?>" class="btn btn-sm btn-primary btn-icon-split">
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

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>Tanggal</th>
                        <th>Armada</th>
                        <th>PIC 1</th>
                        <th>PIC 2</th>
                        <th>Foto</th>
                        <th>Keterangan</th>
                        <th>User</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                $no = 1;
                if ($check_list_armada) :
                    foreach ($check_list_armada as $cl) :
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $cl->tgl_laporan; ?></td>
                        <td><?= $cl->nama_armada; ?></td>
                        <td><?= $cl->montir_1; ?></td>
                        <td><?= $cl->montir_2; ?></td>
                        <td>
                            <img width="30" src="<?= base_url() ?>assets/images/montir/<?= $cl->image; ?>" alt=""
                                class="">
                        </td>
                        <td><?= $cl->keterangan; ?></td>
                        <td><?= $cl->nama; ?></td>
                        <td>
                            <a href="<?= base_url('check_list_armada/edit/') . $cl->id_check_list_armada; ?>"
                                class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a>

                            <a href="<?= base_url('check_list_armada/delete/') . $cl->id_check_list_armada; ?>"
                                class="btn btn-danger btn-circle btn-sm delete"><i class="fa fa-trash"></i></a>
                        </td>
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
function filter() {
    const startDate = $("#startDate").val();
    const endDate = $("#endDate").val();

    window.location.href = `check_list_armada?start_date=${startDate}&end_date=${endDate}`;
}

function resetFilter() {
    window.location.href = 'check_list_armada'
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
        title: 'Yakin mau hapus?',
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