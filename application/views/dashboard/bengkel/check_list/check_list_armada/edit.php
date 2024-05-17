<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Edit Check List Armada
                        </h4>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <?= form_open_multipart('', [], ['id_check_list_armada' => $check_list['id_check_list_armada']]); ?>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="tgl_laporan">Tanggal Laporan</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('tgl_laporan', $check_list['tgl_laporan']); ?>" name="tgl_laporan"
                            type="date" class="form-control">
                        <?= form_error('tgl_laporan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="armada_id">Armada</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="armada_id" id="armada_id" class="custom-select">
                                <option value="" disabled>Pilih Armada</option>
                                <?php foreach ($armada as $ar) : ?>
                                <option <?= $check_list['armada_id'] == $ar['id_armada'] ? 'selected' : ''; ?>
                                    <?= set_select('armada_id', $ar['id_armada']) ?> value="<?= $ar['id_armada'] ?>">
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
                    <label class="col-md-3 text-md-right" for="montir_1">PIC Montir 1</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="montir_1" id="montir_1" class="custom-select">
                                <option selected disabled>Pilih Montir</option>
                                <?php foreach ($montir as $ar) : ?>
                                <option <?= $check_list['montir_1'] == $ar['nama_montir'] ? 'selected' : ''; ?>
                                    <?= set_select('montir_1', $ar['id_montir']) ?> value="<?= $ar['nama_montir'] ?>">
                                    <?= $ar['nama_montir'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-primary" href="<?= base_url('montir/tambah'); ?>"><i
                                        class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('montir_1', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="montir_2">PIC Montir 2</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="montir_2" id="montir_2" class="custom-select">
                                <option selected disabled>Pilih Montir</option>
                                <?php foreach ($montir as $ar) : ?>
                                <option <?= $check_list['montir_2'] == $ar['nama_montir'] ? 'selected' : ''; ?>
                                    <?= set_select('montir_2', $ar['id_montir']) ?> value="<?= $ar['nama_montir'] ?>">
                                    <?= $ar['nama_montir'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="image">Upload Foto</label>
                    <div class="col-3">
                        <img src="<?= base_url('assets/images/montir/') . $check_list['image']; ?>"
                            alt="<?= $check_list['image']; ?>" class="rounded shadow-sm img-thumbnail">
                    </div>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input name="image" id="image" type="file" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="keterangan">Keterangan</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input value="<?= set_value('keterangan', $check_list['keterangan']); ?>"
                                placeholder="Keterangan" name="keterangan" id="keterangan" type="text"
                                class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script>
<?php if ($this->session->flashdata('flash')) { ?>
var isi = <?php echo json_encode($this->session->flashdata('flash')) ?>;
Swal.fire({
    title: "Berhasil!",
    text: "<?= $this->session->flashdata('flash') ?>",
    icon: "success",
    button: false,
    timer: 5000,
});
<?php } ?>

<?php if ($this->session->flashdata('error')) { ?>
var isi = <?php echo json_encode($this->session->flashdata('error')) ?>;
Swal.fire({
    title: "Gagal!",
    text: "<?= $this->session->flashdata('error') ?>",
    icon: "error",
    button: false,
    timer: 5000,
});
<?php } ?>
</script>