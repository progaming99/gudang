<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Input Laporan Oli
                        </h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= form_open('', [], ['user_id' => $this->session->userdata('login_session')['user']]); ?>

                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="id_oli_masuk">Merk oli</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <select name="id_oli_masuk" id="id_oli_masuk" class="custom-select">
                                <option value="" selected disabled>Pilih Oli</option>
                                <?php foreach ($oli as $o) : ?>
                                <option value="<?= $o['id_oli_masuk'] ?>">
                                    <?= $o['oli_id'] . ' | ' . $o['id_oli_masuk'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?= form_error('id_oli_masuk', '<small class="text-danger">', '</small>'); ?>
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