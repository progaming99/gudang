<!-- <style>
/* CSS untuk input yang tidak valid */
input:invalid {
    border-color: red;
}

/* CSS untuk select yang tidak valid */
select:invalid {
    border-color: red;
}

/* CSS untuk textarea yang tidak valid */
textarea:invalid {
    border-color: red;
}
</style> -->


<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Tambah Check List Armada
                        </h4>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <?= form_open_multipart('', [], ['user_id' => $this->session->userdata('login_session')['user'], 'class' => 'needs-validation', 'novalidate' => '']); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="tgl_laporan">Tanggal Laporan</label>
                    <div class="col-md-9">
                        <?php
                            // Mendapatkan tanggal dalam format "tanggal bulan tahun" (d F Y)
                            $tgl_value = set_value('tgl_laporan', date('Y-m-d'));
                            $tgl_display = date('d F Y', strtotime($tgl_value));
                        ?>
                        <input value="<?= $tgl_value; ?>" name="tgl_laporan" type="date" class="form-control" required>
                        <?= form_error('tgl_laporan', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                            Please provide a valid date.
                        </div>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="armada_id">Armada</label>
                    <div class="col-md-9">
                        <div class="input-group">

                            <select name="armada_id" id="armada_id" class="custom-select">
                                <option value="" selected disabled>Pilih Armada</option>
                                <?php foreach ($armada as $ar) : ?>
                                <option
                                    <?= set_select('armada_id', $ar['id_armada'], isset($_POST['armada_id']) && $_POST['armada_id'] == $ar['id_armada']) ?>
                                    value="<?= $ar['id_armada'] ?>">
                                    <?= $ar['nama_armada'] ?>
                                </option>
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
                    <label class="col-md-3 text-md-right" for="montir_id">PIC Montir 1</label>
                    <div class="col-md-9">
                        <div class="input-group">

                            <select name="montir_1" id="montir_id" class="custom-select">
                                <option selected disabled>Pilih Montir</option>
                                <?php foreach ($montir as $ar) : ?>
                                <option
                                    <?= set_select('montir_id', $ar['id_montir'], isset($_POST['montir_id']) && $_POST['montir_id'] == $ar ['id_montir']) ?>
                                    value="<?= $ar['nama_montir'] ?>">
                                    <?= $ar['nama_montir'] ?>
                                </option>
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
                                <option value="<?= $ar['nama_montir'] ?>">
                                    <?= $ar['nama_montir'] ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="image">Upload Foto</label>
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
                            <input value="<?= set_value('keterangan'); ?>" placeholder="Keterangan" name="keterangan"
                                id="keterangan" type="text" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="col-md-6 position-relative">
                    <label for="validationTooltip03" class="form-label">City</label>
                    <input type="text" class="form-control" id="validationTooltip03" required>
                    <div class="invalid-tooltip">
                        Please provide a valid city.
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

<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
    crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    <?php if ($this->session->flashdata('error')): ?>
    Swal.fire({
        title: "Gagal!",
        text: "<?= $this->session->flashdata('error') ?>",
        icon: "error",
        button: false,
        timer: 5000,
    });
    <?php unset($_SESSION['error']); endif; ?>

        // JavaScript to handle form submission and validation
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    // Loop over form elements to check if they are empty
                    Array.from(form.elements).forEach(input => {
                        if (!input.value) {
                            input.classList.add(
                                'is-invalid'); // Add 'is-invalid' class if empty
                        } else {
                            input.classList.remove(
                                'is-invalid'
                            ); // Remove 'is-invalid' class if not empty
                        }
                    });

                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
});
</script>