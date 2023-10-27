<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Edit Ban
                        </h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= form_open('', [], ['stok' => 0, 'id_ban' => $ban['id_ban']]); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="merk">Merk Ban</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('merk', $ban['merk']); ?>" name="merk" id="merk" type="text"
                            class="form-control" placeholder="Merk Ban...">
                        <?= form_error('merk', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="type">Type Ban</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="type" id="type" class="custom-select">
                                <?php foreach ($type as $j) : ?>
                                <?php if ($j == $ban['type']) : ?>
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
                    <label class="col-md-3 text-md-right" for="ukuran">Ukuran</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('ukuran', $ban['ukuran']); ?>" name="ukuran" id="ukuran"
                            type="number" class="form-control" placeholder="Ukuran Ban">
                        <?= form_error('ukuran', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="harga">Harga</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('harga', $ban['harga']); ?>" name="harga" id="harga" type="number"
                            class="form-control" placeholder="Harga Ban">
                        <?= form_error('harga', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="stok">Stok</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('stok', $ban['stok']); ?>" name="stok" id="stok" type="number"
                            class="form-control" placeholder="Stok Ban" readonly>
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