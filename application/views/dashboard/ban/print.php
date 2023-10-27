<table class="table">
    <thead>
        <tr>
            <th scope="col">Nama Armada</th>
            <th scope="col">Nama Supir</th>
            <th scope="col">Tanggal Pasang Baru</th>
            <th scope="col">Tanggal Ganti Baru</th>
            <th scope="col">Rencana Ganti Berikutnya</th>
            <th scope="col">KM Pasang Baru</th>
            <th scope="col">KM Ganti Ban</th>
            <th scope="col">Nomor Posisi Ban</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?= $ban['nomor_armada']; ?></td>
            <td><?= $ban['nama_supir']; ?></td>
            <td><?= $ban['tanggal_pasang']; ?></td>
            <td><?= $ban['tanggal_ganti']; ?></td>
            <td><?= $ban['rencana_ganti']; ?></td>
            <td><?= $ban['km_pasang']; ?></td>
            <td><?= $ban['km_ganti']; ?></td>
            <td><?= $ban['nomor_posisi']; ?></td>
        </tr>
    </tbody>

    <thead>
        <tr>
            <th scope="col">Merk Ban</th>
            <th scope="col">Type Ban</th>
            <th scope="col">Ukuran Ban</th>
            <th scope="col">Nomor Seri Ban Baru</th>
            <th scope="col">Nomor Seri Ban Lama</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Harga Ban</th>
            <th scope="col">Total Harga</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?= $ban['merk']; ?></td>
            <td><?= $ban['type']; ?></td>
            <td><?= $ban['ukuran']; ?></td>
            <td><?= $ban['nomor_seri_baru']; ?></td>
            <td><?= $ban['nomor_seri_lama']; ?></td>
            <td><?= $ban['harga']; ?></td>
            <td><?= $ban['harga']; ?></td>
            <td><?= $ban['total_harga']; ?></td>
        </tr>
    </tbody>
</table>

<script type="text/javascript">
window.print();
</script>