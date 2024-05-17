<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Check List Perbaikan
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
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>Tanggal</th>
                        <th>Armada</th>
                        <th>Supir</th>
                        <th>Kernet</th>
                        <th>Kesiapan Beroperasi</th>
                        <th>Catatan</th>
                        <th>User</th>
                        <?php if ($role == 'admin' || $role == 'finance'): ?>
                        <!-- <th>Aksi</th> -->
                        <?php endif; ?>
                    </tr>
                </thead>

                <tbody>
                    <?php
                $no = 1;
                if ($check_list) :
                    foreach ($check_list as $cl) :
                // Add a check for the "Belum Selesai" status
                if ($cl->kelayakan == 'TIDAK LAYAK JALAN') :
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $cl->tanggal; ?></td>
                        <td><?= $cl->nama_armada; ?></td>
                        <td><?= $cl->nama_supir; ?></td>
                        <td><?= $cl->nama_kernet; ?></td>
                        <td><?= $cl->kelayakan; ?></td>
                        <td><?= $cl->catatan; ?></td>
                        <td><?= $cl->nama; ?></td>
                        <?php if ($role == 'admin' || $role == 'finance'): ?>
                        <!-- <td>
                    <a href="<?= base_url('check_list/delete/') . $cl->id_check_list; ?>"
                        class="btn btn-danger btn-circle btn-sm delete"><i class="fa fa-trash"></i></a>
                </td> -->
                        <?php endif; ?>
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
//tombol hapus
$('.delete').on('click', function(e) {

    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Hapus Laporan?',
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
</script>