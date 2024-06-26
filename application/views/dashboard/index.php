<div class="row">
    <!-- <div class="col-xl-3 col-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Data Barang</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $barang; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-folder fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="col-xl-3 col-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Stok
                                    Oli
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php
                        if (isset($oli) && is_numeric($oli)) {
                            echo $oli;
                        } else {
                            echo "0"; // Display a message if $aki is not set or not numeric.
                        }
                        ?> Liter
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 50%"
                                        aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-toolbox fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Stok Aki</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                        if (isset($aki) && is_numeric($aki)) {
                            echo $aki;
                        } else {
                            echo "0"; // Display a message if $aki is not set or not numeric.
                        }
                        ?> Unit
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-car-battery fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Stok Ban</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                        if (isset($ban) && is_numeric($ban)) {
                            echo $ban;
                        } else {
                            echo "0"; // Display a message if $aki is not set or not numeric.
                        }
                        ?> Unit
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-truck-monster fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Data Supplier</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                        if (isset($supplier) && is_numeric($supplier)) {
                            echo $supplier;
                        } else {
                            echo "Kosong!"; // Display a message if $aki is not set or not numeric.
                        }
                        ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="col-xl-3 col-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total User</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                        if (isset($user) && is_numeric($user)) {
                            echo $user;
                        } else {
                            echo "0"; // Display a message if $aki is not set or not numeric.
                        }
                        ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-plus fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="col-xl-3 col-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Nominal Aki</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp
                            <?php
                        if (isset($total_aki) && is_numeric($total_aki)) {
                            echo number_format($total_aki, 0, '.', ',');
                        } else {
                            echo "0"; // Display a message if $jumlah_pengeluaran is not set or not numeric.
                        }
                        ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-money-bill fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Nominal Ban</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp
                            <?php
                        if (isset($total_ban) && is_numeric($total_ban)) {
                            echo number_format($total_ban, 0, '.', ',');
                        } else {
                            echo "0"; // Display a message if $jumlah_pengeluaran is not set or not numeric.
                        }
                        ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-money-bill fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Nominal Sparepart
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp
                            <?php
                        if (isset($total_sparepart) && is_numeric($total_sparepart)) {
                            echo number_format($total_sparepart, 0, '.', ',');
                        } else {
                            echo "0"; // Display a message if $jumlah_pengeluaran is not set or not numeric.
                        }
                        ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-money-bill fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Nominal Oli
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp
                            <?php
                        if (isset($total_oli) && is_numeric($total_oli)) {
                            echo number_format($total_oli, 0, '.', ',');
                        } else {
                            echo "0"; // Display a message if $jumlah_pengeluaran is not set or not numeric.
                        }
                        ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-money-bill fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl col-lg">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header bg-primary py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-white">Total Nominal Gudang
                </h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="h5 mb-0 font-weight-bold text-gray-800" style="font-size: 50px; font-family:ChunkFive;">Rp
                    <?php
                        if (isset($total_harga) && is_numeric($total_harga)) {
                            echo number_format($total_harga, 0, '.', ',');
                        } else {
                            echo "Rp 0"; // Display a message if $jumlah_pengeluaran is not set or not numeric.
                        }
                        ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header bg-primary py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-white">Total Transaksi Sparepart Perbulan pada Tahun
                    <?= date('Y'); ?>
                </h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas id="myAreaChart" width="669" height="320" class="chartjs-render-monitor"
                        style="display: block; width: 669px; height: 320px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header bg-primary py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-white">Transaksi Sparepart</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas id="myPieChart" width="302" height="245" class="chartjs-render-monitor"
                        style="display: block; width: 302px; height: 245px;"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Sparepart Masuk
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-danger"></i> Sparepart Keluar
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header bg-warning py-3">
                <h6 class="m-0 font-weight-bold text-white text-center">Stok Sparepart Minimum</h6>
            </div>
            <div class="table-responsive">
                <table class="table mb-0 text-center table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Sparepart</th>
                            <th>Stok</th>
                            <th>Pasok</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($barang_min) :
                            foreach ($barang_min as $b) :
                        ?>
                        <tr>
                            <td><?= $b['nama_barang']; ?></td>
                            <td><?= $b['stok']; ?></td>
                            <td>
                                <a href="<?= base_url('barangmasuk/tambah/') . $b['id_barang'] ?>"
                                    class="btn btn-warning btn-sm"><i class="fa fa-plus"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="3" class="text-center">
                                Tidak ada barang stok minim
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header bg-success py-3">
                <h6 class="m-0 font-weight-bold text-white text-center">5 Transaksi Terakhir Barang Masuk</h6>
            </div>
            <div class="table-responsive">
                <table class="table mb-0 table-sm table-striped text-center">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transaksi['barang_masuk'] as $tbm) : ?>
                        <tr>
                            <td><strong><?= $tbm['tanggal_masuk']; ?></strong></td>
                            <td><?= $tbm['nama_barang']; ?></td>
                            <td><span class="badge badge-success"><?= $tbm['jumlah_masuk']; ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header bg-danger py-3">
                <h6 class="m-0 font-weight-bold text-white text-center">5 Transaksi Terakhir Barang Keluar</h6>
            </div>
            <div class="table-responsive">
                <table class="table mb-0 table-sm table-striped text-center">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transaksi['barang_keluar'] as $tbk) : ?>
                        <tr>
                            <td><strong><?= $tbk['tanggal_keluar']; ?></strong></td>
                            <td><?= $tbk['nama_barang']; ?></td>
                            <td><span class="badge badge-danger"><?= $tbk['jumlah_keluar']; ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>