<div class="card shadow-sm border-bottom-primary">
    <div class="card-body">
        <!-- <a href="<?= base_url('Ban/print'); ?>" class="btn btn-success mb-4"><i class="fa fa-print"></i> Print</a> -->
        <div class="table-responsive">
            <table class="table table-bordered border-primary">
                <tbody class="table-group-divider">
                    <tr>
                        <th scope="row" class="col-lg-5">Nama Armada</th>
                        <td><?= $ban->nomor_armada; ?></td>
                </tbody>
                <tbody class="table-group-divider">
                    <tr>
                        <th scope="row">Nama Supir</th>
                        <td><?= $ban->nama_supir; ?></td>
                </tbody>
                <tbody class="table-group-divider">
                    <tr>
                        <th scope="row">Tanggal Pasang Baru</th>
                        <td><?= date('d F Y',strtotime("$ban->tanggal_pasang")); ?></td>
                </tbody>
                <tbody class="table-group-divider">
                    <tr>
                        <th scope="row">Tanggal Ganti Baru</th>
                        <td><?= date('d F Y',strtotime("$ban->tanggal_ganti")); ?></td>
                </tbody>
                <tbody class="table-group-divider">
                    <tr>
                        <th scope="row">Rencana Ganti Berikutnya</th>
                        <td><?= date('d F Y',strtotime("$ban->rencana_ganti")); ?></td>
                </tbody>
                <tbody class="table-group-divider">
                    <tr>
                        <th scope="row">KM Pasang Baru</th>
                        <td><?= $ban->km_pasang; ?></td>
                </tbody>
                <tbody class="table-group-divider">
                    <tr>
                        <th scope="row">KM Ganti Ban</th>
                        <td><?= $ban->km_ganti; ?></td>
                </tbody>
                <tbody class="table-group-divider">
                    <tr>
                        <th scope="row">Nomor Posisi Ban</th>
                        <td><?= $ban->nomor_posisi; ?></td>
                        </td>
                </tbody>
                <tbody class="table-group-divider">
                    <tr>
                        <th scope="row">Merk Ban</th>
                        <td><?= $ban->merk; ?></td>
                        </td>
                </tbody>
                <tbody class="table-group-divider">
                    <tr>
                        <th scope="row">Type Ban</th>
                        <td><?= $ban->type; ?></td>
                        </td>
                </tbody>
                <tbody class="table-group-divider">
                    <tr>
                        <th scope="row">Ukuran Ban</th>
                        <td><?= $ban->ukuran; ?></td>
                        </td>
                </tbody>
                <tbody class="table-group-divider">
                    <tr>
                        <th scope="row">Nomor Seri Ban Baru</th>
                        <td><?= $ban->nomor_seri_baru; ?></td>
                        </td>
                </tbody>
                <tbody class="table-group-divider">
                    <tr>
                        <th scope="row">Nomor Seri Ban Lama</th>
                        <td><?= $ban->nomor_seri_lama; ?></td>
                        </td>
                </tbody>
                <tbody class="table-group-divider">
                    <tr>
                        <th scope="row">Keterangan</th>
                        <td><?= $ban->keterangan; ?></td>
                        </td>
                </tbody>
                <tbody class="table-group-divider">
                    <tr>
                        <th scope="row">Keterangan</th>
                        <td><?= $ban->harga; ?></td>
                        </td>
                </tbody>
            </table>
        </div>
    </div>
</div>