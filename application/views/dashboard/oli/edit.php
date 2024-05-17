<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Edit Oli
                        </h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= form_open('', [], ['stok' => 0, 'id_oli' => $oli['id_oli']]); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="nama">Jenis</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('nama_oli', $oli['nama_oli']); ?>" name="nama_oli" id="nama_oli"
                            type="text" class="form-control" placeholder="Jenis Oli">
                        <?= form_error('nama_oli', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="harga">Harga</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('harga', $oli['harga']); ?>" name="harga" id="harga" type="number"
                            class="form-control" placeholder="Harga Oli">
                        <?= form_error('harga', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="stok">Stok</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('stok', $oli['stok']); ?>" name="stok" id="stok" type="number"
                            class="form-control" placeholder="Stok Oli" readonly>
                        <?= form_error('stok', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>


                <div class="row form-group">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-secondary">Reset</bu>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>