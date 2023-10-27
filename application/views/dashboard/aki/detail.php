<div class="card shadow-sm border-bottom-primary">
    <div class="card-body">
        <!-- <a href="<?= base_url('Aki/print'); ?>" class="btn btn-success mb-4"><i class="fa fa-print"></i> Print</a> -->
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <th>Nomor Armada</th>
                        <th>Nama Supir</th>
                        <th>Tanggal Beli Aki</th>
                        <th>Tanggal Pasang Aki Baru</th>
                        <th>Tanggal Pasang Aki Lama</th>
                        <th>Lama Pemakaian (Hari)</th>
                        <th>Lama Pemakaian (Tahun)</th>
                        <th>Masalah</th>
                        <th>Keterangan Lain</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $aki->nomor_armada; ?></td>
                        <td><?= $aki->nama_supir; ?></td>
                        <td><?= date('d F Y', strtotime("$aki->tanggal_beli")); ?></td>
                        <td><?= date('d F Y', strtotime("$aki->tanggal_pasang_baru")); ?></td>
                        <td><?= date('d F Y', strtotime("$aki->tanggal_pasang_lama")); ?></td>
                        <td><?= $aki->lama_pemakaian_hari; ?> Hari</td>
                        <td><?= $aki->lama_pemakaian_tahun; ?> Tahun</td>
                        <td><?= $aki->masalah; ?></td>
                        <td><?= $aki->keterangan; ?></td>
                    </tr>
                </tbody>
            </table>

            <table class="table table-bordered" id="dataTable">
                <tbody class="table-group-divider">
                    <tr>
                        <th scope="row" class="col-lg-5">Nomor Armada</th>
                        <td><?= $aki->nomor_armada; ?></td>
                </tbody>
                <tbody class="table-group-divider">
                    <tr>
                        <th scope="row">Tanggal Beli Aki</th>
                        <td><?= date('d F Y', strtotime("$aki->tanggal_beli")); ?></td>
                </tbody>
                <tbody class="table-group-divider">
                    <tr>
                        <th scope="row">Tanggal Pasang Aki Baru</th>
                        <td><?= date('d F Y', strtotime("$aki->tanggal_pasang_baru")); ?></td>
                </tbody>
                <tbody class="table-group-divider">
                    <tr>
                        <th scope="row">Tanggal Pasang Aki Lama</th>
                        <td><?= date('d F Y', strtotime("$aki->tanggal_pasang_lama")); ?></td>
                </tbody>
                <tbody class="table-group-divider">
                    <tr>
                        <th scope="row">Lama Pemaikaian (Hari)</th>
                        <td><?= $aki->lama_pemakaian_hari; ?> Hari</td>
                </tbody>
                <tbody class="table-group-divider">
                    <tr>
                        <th scope="row">Lama Pemakaian (Tahun)</th>
                        <td><?= $aki->lama_pemakaian_tahun; ?></td>
                </tbody>
                <tbody class="table-group-divider">
                    <tr>
                        <th scope="row">Ada Masalah?</th>
                        <td><?= $aki->masalah; ?></td>
                </tbody>
                <tbody class="table-group-divider">
                    <tr>
                        <th scope="row">Keterangan</th>
                        <td><?= $aki->keterangan; ?></td>
                        </td>
                </tbody>
            </table>
        </div>
    </div>
</div>