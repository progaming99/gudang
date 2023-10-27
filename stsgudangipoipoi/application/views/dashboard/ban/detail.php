<div class="card shadow-sm border-bottom-primary">
    <div class="card-body">
        <a href="<?= base_url('Ban/print'); ?>" class="btn btn-success mb-4"><i class="fa fa-print"></i> Print</a>
        <div class="table-responsive">
            <table class="table table-bordered" id="" width="auto" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Armada</th>
                        <th>Nama Supir</th>
                        <th>Tanggal Pasang Baru</th>
                        <th>Tanggal Ganti Baru</th>
                        <th>Rencana Ganti Berikutnya</th>
                        <th>KM Pasang Baru</th>
                        <th>KM Ganti Ban</th>
                        <th>Nomor Posisi Ban</th>
                        <th>Merk Ban</th>
                        <th>Type Ban</th>
                        <th>Ukuran Ban</th>
                        <th>Nomor Seri Ban Baru</th>
                        <th>Nomor Seri Ban Lama</th>
                        <th>Keterangan</th>
                        <th>Harga Ban</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $ban->nomor_armada; ?></td>
                        <td><?= $ban->nama_supir; ?></td>
                        <td><?= date('d F Y',strtotime("$ban->tanggal_pasang")); ?></td>
                        <td><?= date('d F Y',strtotime("$ban->tanggal_ganti")); ?></td>
                        <td><?= date('d F Y',strtotime("$ban->rencana_ganti")); ?></td>
                        <td><?= $ban->km_pasang; ?></td>
                        <td><?= $ban->km_ganti; ?></td>
                        <td><?= $ban->nomor_posisi; ?></td>
                        <td><?= $ban->merk; ?></td>
                        <td><?= $ban->type; ?></td>
                        <td><?= $ban->ukuran; ?></td>
                        <td><?= $ban->nomor_seri_baru; ?></td>
                        <td><?= $ban->nomor_seri_lama; ?></td>
                        <td><?= $ban->keterangan; ?></td>
                        <td><?= $ban->harga; ?></td>
                        <td><?= $ban->total_harga; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>