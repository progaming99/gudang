<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Input Ban Keluar
                        </h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= form_open('', [], ['id_ban_keluar' => $id_ban_keluar, 'user_id' => $this->session->userdata('login_session')['user']]); ?>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="id_ban_keluar">Kode Transaksi Keluar</label>
                    <div class="col-md-4">
                        <input value="<?= $id_ban_keluar; ?>" type="text" readonly="readonly" class="form-control">
                        <?= form_error('id_ban_keluar', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="tanggal_keluar">Tanggal Keluar</label>
                    <div class="col-md-4">
                        <?php
                            // Menggunakan format "Y-m-d" untuk tanggal hari ini
                            $tanggal_keluar_value = set_value('tanggal_keluar', date('Y-m-d'));
                        ?>
                        <input value="<?= $tanggal_keluar_value; ?>" name="tanggal_keluar" id="tanggal_keluar"
                            type="date" class="form-control" placeholder="Tanggal Masuk...">
                        <?= form_error('tanggal_keluar', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="ban_id">Merk Ban</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <select name="ban_id" id="ban_id" class="custom-select">
                                <option value="" selected disabled>Pilih Merk</option>
                                <?php foreach ($ban as $b) : ?>
                                <option value="<?= $b['id_ban'] ?>">
                                    <?= $b['id_ban'] . ' | ' . $b['merk'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?= form_error('ban_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="supplier">Supplier</label>
                    <div class="col-md-5">
                        <input readonly id="supplier_ban_keluar" type="text" class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="harga">Harga</label>
                    <div class="col-md-5">
                        <input readonly id="harga" type="text" class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="stok">Stok</label>
                    <div class="col-md-5">
                        <input readonly="readonly" id="stok" type="number" class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="jumlah_keluar">Jumlah Keluar</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input value="<?= set_value('jumlah_keluar'); ?>" name="jumlah_keluar" id="jumlah_keluar"
                                type="number" class="form-control" placeholder="Jumlah Keluar..." min="1">
                            <div class="input-group-append">
                                <span class="input-group-text" id="">Unit</span>
                            </div>
                        </div>
                        <?= form_error('jumlah_keluar', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="tgl_pasang">Tanggal Pasang</label>
                    <div class="col-md-4">
                        <input value="<?= set_value('tgl_pasang', date('d-m-Y')); ?>" name="tgl_pasang" id="tgl_pasang"
                            type="date" class="form-control" placeholder="Tanggal Masuk...">
                        <?= form_error('tgl_pasang', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="tgl_ganti">Tanggal Ganti</label>
                    <div class="col-md-4">
                        <input value="<?= set_value('tgl_ganti', date('d-m-Y')); ?>" name="tgl_ganti" id="tgl_ganti"
                            type="date" class="form-control" placeholder="Tanggal Masuk...">
                        <?= form_error('tgl_ganti', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="rencana_ganti">Rencana Ganti</label>
                    <div class="col-md-4">
                        <input value="<?= set_value('rencana_ganti', date('d-m-Y')); ?>" name="rencana_ganti"
                            id="rencana_ganti" type="date" class="form-control" placeholder="Tanggal Masuk...">
                        <?= form_error('rencana_ganti', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <!-- <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="km_pasang">KM Pasang</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input value="<?= set_value('km_pasang'); ?>" name="km_pasang" id="km_pasang" type="number"
                                class="form-control" placeholder="KM Pasang...">
                            <div class="input-group-append">
                                <span class="input-group-text" id="">KM</span>
                            </div>
                        </div>
                        <?= form_error('km_pasang', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="km_ganti">KM Ganti</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input value="<?= set_value('km_ganti'); ?>" name="km_ganti" id="km_ganti" type="number"
                                class="form-control" placeholder="KM Ganti...">
                            <div class="input-group-append">
                                <span class="input-group-text" id="">KM</span>
                            </div>
                        </div>
                        <?= form_error('km_ganti', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div> -->

                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="no_posisi">No Posisi Ban</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <select name="no_posisi" id="no_posisi" class="custom-select">
                                <option value="" selected disabled>Pilih No Posisi</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                            </select>
                        </div>
                        <?= form_error('no_posisi', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="no_seri_baru">No Seri Baru</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input value="<?= set_value('no_seri_baru'); ?>" name="no_seri_baru" id="no_seri_baru"
                                type="text" class="form-control" placeholder="No Seri Baru...">
                        </div>
                        <?= form_error('no_seri_baru', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="no_seri_lama">No Seri Lama</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input value="<?= set_value('no_seri_lama'); ?>" name="no_seri_lama" id="no_seri_lama"
                                type="text" class="form-control" placeholder="No Seri Lama...">
                        </div>
                        <?= form_error('no_seri_lama', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="armada_id">Armada</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <select name="armada_id" id="armada_id" class="custom-select">
                                <option value="" selected disabled>Pilih Armada</option>
                                <?php foreach ($armada as $ar) : ?>
                                <option value="<?= $ar['id_armada'] ?>">
                                    <?= $ar['nama_armada'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-primary" href="<?= base_url('armada/tambah'); ?>"><i
                                        class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('armada_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="supir_id">Supir</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <select name="supir_id" id="supir_id" class="custom-select">
                                <option value="" selected disabled>Pilih Supir</option>
                                <?php foreach ($supir as $sp) : ?>
                                <option value="<?= $sp['id_supir'] ?>">
                                    <?= $sp['nama_supir'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-primary" href="<?= base_url('supir/tambah'); ?>"><i
                                        class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('supir_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="montir_id">Montir</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <select name="montir_id" id="montir_id" class="custom-select">
                                <option value="" selected disabled>Pilih Montir</option>
                                <?php foreach ($montir as $mt) : ?>
                                <option value="<?= $mt['id_montir'] ?>">
                                    <?= $mt['nama_montir'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-primary" href="<?= base_url('montir/tambah'); ?>"><i
                                        class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('montir_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col offset-md-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
    crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
<?php
    if ($this->session->flashdata('error')) { ?>
var isi = <?php echo json_encode($this->session->flashdata('error')) ?>;
Swal.fire({
    title: "Gagal",
    text: "<?= $this->session->flashdata('error') ?>",
    icon: "error",
    button: false,
    timer: 5000,
});
<?php
        unset($_SESSION['error']);
    } ?>
</script>