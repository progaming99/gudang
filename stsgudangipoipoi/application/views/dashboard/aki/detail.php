<div class="card shadow-sm border-bottom-primary">
    <div class="card-body">
        <a href="<?= base_url('Aki/print'); ?>" class="btn btn-success mb-4"><i class="fa fa-print"></i> Print</a>
        <div class="table-responsive">
            <table class="table table-bordered" id="" width="auto" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nomor Armada</th>
                        <th>Nama Supir</th>
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
                        <td><?= date('d F Y',strtotime("$aki->tanggal_pasang_baru")); ?></td>
                        <td><?= date('d F Y',strtotime("$aki->tanggal_pasang_lama")); ?></td>
                        <td><?= $aki->lama_pemakaian_hari; ?></td>
                        <td><?= $aki->lama_pemakaian_tahun; ?></td>
                        <td><?= $aki->masalah; ?></td>
                        <td><?= $aki->keterangan; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>