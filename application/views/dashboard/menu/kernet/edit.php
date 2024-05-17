<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Edit Kernet
                        </h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= form_open('', [], ['id_kernet' => $kernet['id_kernet']]); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="nama_kernet">Nama Kernet</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('nama_kernet', $kernet['nama_kernet']); ?>" name="nama_kernet"
                            id="nama_kernet" type="text" class="form-control">
                        <?= form_error('nama_kernet', '<small class="text-danger">', '</small>'); ?>
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