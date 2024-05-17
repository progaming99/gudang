<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Edit Aki
                        </h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= form_open('', [], ['stok' => 0, 'id_aki' => $aki['id_aki']]); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="merk">Merk</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('merk', $aki['merk']); ?>" name="merk" id="merk" type="text"
                            class="form-control" placeholder="Merk aki...">
                        <?= form_error('merk', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="kondisi">Kondisi</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="kondisi" id="kondisi" class="custom-select">
                                <?php foreach ($kondisi as $j) : ?>
                                <?php if ($j == $aki['kondisi']) : ?>
                                <option value="<?= $j; ?>" selected><?= $j; ?></option>
                                <?php else : ?>
                                <option value="<?= $j ?>"><?= $j; ?></option>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?= form_error('kondisi', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="harga">Harga</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('harga', $aki['harga']); ?>" name="harga" id="harga" type="number"
                            class="form-control" placeholder="Harga Aki">
                        <?= form_error('harga', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="stok">Stok</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('stok', $aki['stok']); ?>" name="stok" id="stok" type="number"
                            class="form-control" placeholder="Stok Aki" readonly>
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