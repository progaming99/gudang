<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary text-center">
                    Data Perbaikan Armada
                </h4>
            </div>
        </div>
    </div>

    <table class="table table-striped w-100 dt-responsive nowrap" id="">
        <thead>
            <tr>
                <th>Armada</th>
                <th>Jenis Kerusakan</th>
                <th>Tanggal Masuk Bengkel</th>
                <th>PIC Montir 1</th>
                <th>PIC Montir 2</th>
                <th>Level Kerusakan</th>
                <th>Tindakan Hari Ini</th>
                <th>Langkah Perbaikan</th>
                <th>Masalah</th>
                <th>Rencana Selesai</th>
                <th>User</th>
            </tr>
        </thead>
        <tbody>
            <?php
                    $tanggal_masuk = date('d F Y', strtotime($perbaikan->tgl_masuk));
                    $tanggal_masuk = str_replace(
                        array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'),
                        array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'),
                        $tanggal_masuk
                    );
                ?>
            <tr>
                <td><?= $perbaikan->nama_armada; ?></td>
                <td><?= $perbaikan->jenis_kerusakan; ?></td>
                <td><?= $tanggal_masuk; ?></td>
                <td><?= $perbaikan->montir_1; ?></td>
                <td><?= $perbaikan->montir_2; ?></td>
                <td><?= $perbaikan->nama_level; ?></td>
                <td><?= $perbaikan->progress; ?></td>
                <td><?= $perbaikan->tahapan; ?></td>
                <td><?= $perbaikan->masalah; ?></td>
                <td><?= $perbaikan->rencana_selesai; ?></td>
                <td><?= $perbaikan->nama; ?></td>
            </tr>
        </tbody>
    </table>
</div>