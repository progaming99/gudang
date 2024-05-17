<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary text-center">
                    Data Check List Armada
                </h4>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped w-100 dt-responsive nowrap" id="">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Armada</th>
                    <th>Supir</th>
                    <th>Kernet</th>
                    <th>Kesiapan Beroperasi</th>
                    <th>Keterangan</th>
                    <th>User</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $tanggal_berangkat = date('d F Y', strtotime($check_list->tanggal));
                    $tanggal_berangkat = str_replace(
                        array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'),
                        array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'),
                        $tanggal_berangkat
                    );
                ?>
                <tr>
                    <td><?=  $tanggal_berangkat; ?></td>
                    <td><?= $check_list->nama_armada; ?></td>
                    <td><?= $check_list->nama_supir; ?></td>
                    <td><?= $check_list->nama_kernet; ?></td>
                    <td><?= $check_list->kelayakan; ?></td>
                    <td><?= $check_list->keterangan; ?></td>
                    <td><?= $check_list->nama; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>