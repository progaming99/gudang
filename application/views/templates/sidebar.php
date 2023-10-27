    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-white sidebar sidebar-light accordion shadow-sm" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex text-white align-items-center bg-primary justify-content-center" href="">
                <img src="<?= base_url('assets/img/sts_logo.png'); ?>" alt="" width="50px">
                <div class="sidebar-brand-text mx-3">Gudang Sparepart</div>
            </a>

            <!-- Nav Item - Dashboard -->
            <li <?= $this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '' ? 'class="nav-item active"' : '' ?>
                class="nav-item">
                <a class="nav-link" href="<?= base_url('dashboard'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>



            <!-- Heading -->
            <div class="sidebar-heading bg-primary">
                Stok Gudang
            </div>

            <!-- Nav Item - Dashboard -->
            <li <?= $this->uri->segment(1) == 'Ban' ? 'class="nav-item active"' : '' ?> class="nav-item">
                <a class="nav-link pb-0" href="<?= base_url('Ban'); ?>">
                    <i class="fa fa-truck-monster"></i>
                    <span>Ban</span>
                </a>
            </li>

            <li <?= $this->uri->segment(1) == 'Aki' ? 'class="nav-item active"' : '' ?> class="nav-item">
                <a class="nav-link pb-0" href="<?= base_url('Aki'); ?>">
                    <i class="fa fa-car-battery"></i>
                    <span>Aki</span>
                </a>
            </li>

            <li <?= $this->uri->segment(1) == 'Barang' ? 'class="nav-item active"' : '' ?> class="nav-item">
                <a class="nav-link" href="<?= base_url('Barang'); ?>">
                    <i class="fa fa-toolbox"></i>
                    <span>Sparepart</span>
                </a>
            </li>

            <!-- Heading -->
            <div class="sidebar-heading bg-primary">
                Master
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li <?= in_array($this->uri->segment(1), ['armada', 'supir', 'montir']) ? 'class="nav-item active"' : '' ?>
                class="nav-item">
                <a class="nav-link collapsed pb-0" href="#" data-toggle="collapse" data-target="#collapser"
                    aria-expanded="true" aria-controls="collapser">
                    <!-- <i class="fas fa-fw fa-folder"></i> -->
                    <i class="fa fa-folder-plus"></i>
                    <span>Master User</span>
                </a>
                <div id="collapser" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-light py-2 collapse-inner rounded">
                        <h6 class="collapse-header"><i class="fa-regular fa-rectangle-list"></i>Master</h6>
                        <a class="collapse-item" href="<?= base_url('armada'); ?>"><i class="fa fa-truck-moving"></i>
                            Armada</a>
                        <a class="collapse-item" href="<?= base_url('supir'); ?>"><i class="fa fa-peace"></i>
                            Sopir</a>
                        <a class="collapse-item" href="<?= base_url('montir'); ?>"><i class="fas fa-user-astronaut"></i>
                            Montir</a>
                        <a class="collapse-item" href="<?= base_url('supplier'); ?>"><i class="fas fa-fw fa-users"></i>
                            Supplier</a>
                    </div>
                </div>
            </li>

            <li <?= in_array($this->uri->segment(1), ['satuan', 'jenis', 'barang']) ? 'class="nav-item active"' : '' ?>
                class="nav-item">
                <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#collapseMaster"
                    aria-expanded="true" aria-controls="collapseMaster">
                    <!-- <i class="fas fa-fw fa-folder"></i> -->
                    <i class="fa fa-folder-plus"></i>
                    <span>Satuan Jenis</span>
                </a>
                <div id="collapseMaster" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-light py-2 collapse-inner rounded">
                        <h6 class="collapse-header"><i class="fa-regular fa-rectangle-list"></i>Master</h6>
                        <a class="collapse-item" href="<?= base_url('satuan'); ?>"><i class="fas fa-folder"></i> Satuan
                            Barang</a>
                        <a class="collapse-item" href="<?= base_url('jenis'); ?>"><i class="far fa-folder"></i>
                            Jenis Barang</a>
                    </div>
                </div>
            </li>



            <!-- Heading -->
            <div class="sidebar-heading bg-primary">
                Transaksi Sparepart
            </div>

            <!-- Nav Item - Dashboard -->
            <li <?= $this->uri->segment(1) == 'barangmasuk' ? 'class="nav-item active"' : '' ?> class="nav-item">
                <a class="nav-link pb-0" href="<?= base_url('barangmasuk'); ?>">
                    <i class="fa fa-toolbox"></i> <i class="fas fa-arrow-down"></i>
                    <span>Sparepart Masuk</span>
                </a>
            </li>

            <!-- Nav Item - Dashboard -->
            <li <?= $this->uri->segment(1) == 'barangkeluar' ? 'class="nav-item active"' : '' ?> class="nav-item">
                <a class="nav-link" href="<?= base_url('barangkeluar'); ?>">
                    <i class="fa fa-toolbox"></i> <i class="fas fa-arrow-up"></i>
                    <span>Sparepart Keluar</span>
                </a>
            </li>

            <!-- Heading -->
            <div class="sidebar-heading bg-primary">
                Transaksi Aki
            </div>

            <!-- Nav Item - Dashboard -->
            <li <?= $this->uri->segment(1) == 'aki_masuk' ? 'class="nav-item active"' : '' ?> class="nav-item">
                <a class="nav-link pb-0" href="<?= base_url('aki_masuk'); ?>">
                    <i class="fa fa-car-battery"></i> <i class="fas fa-arrow-down"></i>
                    <span>Aki Masuk</span>
                </a>
            </li>

            <!-- Nav Item - Dashboard -->
            <li <?= $this->uri->segment(1) == 'aki_keluar' ? 'class="nav-item active"' : '' ?> class="nav-item">
                <a class="nav-link" href="<?= base_url('aki_keluar'); ?>">
                    <i class="fa fa-car-battery"></i> <i class="fas fa-arrow-up"></i>
                    <span>Aki Keluar</span>
                </a>
            </li>

            <!-- Heading -->
            <div class="sidebar-heading bg-primary">
                Transaksi Ban
            </div>

            <!-- Nav Item - Dashboard -->
            <li <?= $this->uri->segment(1) == 'ban_masuk' ? 'class="nav-item active"' : '' ?> class="nav-item">
                <a class="nav-link pb-0" href="<?= base_url('ban_masuk'); ?>">
                    <i class="fa fa-truck-monster"></i> <i class="fas fa-arrow-down"></i>
                    <span>Ban Masuk</span>
                </a>
            </li>

            <!-- Nav Item - Dashboard -->
            <li <?= $this->uri->segment(1) == 'ban_keluar' ? 'class="nav-item active"' : '' ?> class="nav-item">
                <a class="nav-link" href="<?= base_url('ban_keluar'); ?>">
                    <i class="fa fa-truck-monster"></i> <i class="fas fa-arrow-up"></i>
                    <span>Ban Keluar</span>
                </a>
            </li>

            <!-- Heading -->
            <div class="sidebar-heading bg-primary">
                Laporan
            </div>

            <li <?= $this->uri->segment(1) == 'laporan' ? 'class="nav-item active"' : '' ?> class="nav-item">
                <a class="nav-link pb-0" href="<?= base_url('laporan'); ?>">
                    <i class="fas fa-fw fa-print"></i>
                    <span>Laporan Sparepart</span>
                </a>
            </li>

            <li <?= $this->uri->segment(1) == 'laporan/aki' ? 'class="nav-item active"' : '' ?> class="nav-item">
                <a class="nav-link pb-0" href="<?= base_url('laporan/aki'); ?>">
                    <i class="fas fa-fw fa-print"></i>
                    <span>Laporan Aki</span>
                </a>
            </li>

            <li <?= $this->uri->segment(2) == 'laporan/ban' ? 'class="nav-item active"' : '' ?> class="nav-item">
                <a class="nav-link" href="<?= base_url('laporan/ban'); ?>">
                    <i class="fas fa-fw fa-print"></i>
                    <span>Laporan Ban</span>
                </a>
            </li>

            <?php if (is_admin()) : ?>


            <!-- Heading -->
            <div class="sidebar-heading bg-primary">
                Settings
            </div>

            <!-- Nav Item -->
            <li <?= $this->uri->segment(1) == 'user' ? 'class="nav-item active"' : '' ?> class="nav-item">
                <a class="nav-link" href="<?= base_url('user'); ?>">
                    <i class="fas fa-fw fa-user-plus"></i>
                    <span>User Management</span>
                </a>
            </li>
            <?php endif; ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-dark bg-primary topbar mb-4 static-top shadow-sm">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link bg-transparent d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars text-white"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline small text-capitalize">
                                    <?= userdata('nama'); ?>
                                </span>
                                <img class="img-profile rounded-circle"
                                    src="<?= base_url() ?>assets/img/avatar/<?= userdata('foto'); ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= base_url('profile'); ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="<?= base_url('profile/setting'); ?>">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="<?= base_url('profile/ubahpassword'); ?>">
                                    <i class="fas fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Change Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">