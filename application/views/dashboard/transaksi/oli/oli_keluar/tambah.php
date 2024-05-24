<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Input Oli Keluar
                        </h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= form_open('', [], ['id_oli_keluar' => $id_oli_keluar, 'user_id' => $this->session->userdata('login_session')['user']]); ?>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="id_oli_keluar">Kode Transaksi Keluar</label>
                    <div class="col-md-4">
                        <input value="<?= $id_oli_keluar; ?>" type="text" readonly="readonly" class="form-control">
                        <?= form_error('id_oli_keluar', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="tanggal_keluar">Tanggal Keluar</label>
                    <div class="col-md-4">
                        <?php
                        // Menggunakan format "Y-m-d" untuk tanggal hari ini
                        $tanggal_keluar_value = set_value('tanggal_keluar', date('Y-m-d'));
                        ?>
                        <input value="<?= $tanggal_keluar_value; ?>" name="tanggal_keluar" id="tanggal_keluar" type="date" class="form-control" placeholder="Tanggal Masuk...">
                        <?= form_error('tanggal_keluar', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="id_oli_masuk">Nama Oli</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <select name="id_oli_masuk" id="id_oli_masuk" class="custom-select">
                                <option value="" selected disabled>Pilih Nama</option>
                                <?php foreach ($oli as $o) : ?>
                                    <option value="<?= $o->id_oli_masuk; ?>" data-id="<?= $o->oli_id; ?>">
                                        <?= $o->oli_id . ' | ' . $o->nama_oli; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-primary" href="<?= base_url('oli/tambah'); ?>"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('id_oli_masuk', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <!-- ID OLI  -->
                <input type="hidden" name="id_oli" id="id_oli" value="">

                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="supplier">Supplier</label>
                    <div class="col-md-5">
                        <input readonly id="supplier_oli_keluar" type="text" class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="harga">Harga</label>
                    <div class="col-md-5">
                        <input readonly id="harga" type="number" class="form-control">
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
                            <input value="<?= set_value('jumlah_keluar'); ?>" name="jumlah_keluar" id="jumlah_keluar" type="number" class="form-control" placeholder="Jumlah Keluar...">
                            <div class="input-group-append">
                                <span class="input-group-text" id="satuan">Satuan</span>
                            </div>
                        </div>
                        <?= form_error('jumlah_keluar', '<small class="text-danger">', '</small>'); ?>
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
                                <a class="btn btn-primary" href="<?= base_url('armada/tambah'); ?>"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('armada_id', '<small class="text-danger">', '</small>'); ?>
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

<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    <?php if ($this->session->flashdata('error')) { ?>
        var isi = <?php echo json_encode($this->session->flashdata('error')) ?>;
        Swal.fire({
            title: "Gagal",
            text: "<?= $this->session->flashdata('error') ?>",
            icon: "error",
            button: false,
            timer: 5000,
        });
    <?php unset($_SESSION['error']);
    } ?>
</script>

<script>
    $(document).on('change', '#id_oli_masuk', function() {
        let selectedOption = $(this).find('option:selected');
        let value = selectedOption.val();
        let [idOliMasuk, oliId] = value.split('|');

        // Set the hidden input value for id_oli
        $('#id_oli').val(oliId);

        let url = '<?= base_url('oli/getstok/'); ?>' + idOliMasuk;
        $.getJSON(url, function(data) {
            $('#satuan').text(data.nama_satuan);
            $('#supplier_oli_keluar').val(data.nama_supplier);
            $('#stok').val(data.stok);
            $('#harga').val(data.harga);
            // Additional processing as needed
        });
    });
</script>