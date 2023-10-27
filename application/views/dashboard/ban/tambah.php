<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Tambah Ban
                        </h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= form_open('', [], ['stok' => 0]); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="id_ban">Kode Ban</label>
                    <div class="col-md-9">
                        <input readonly value="<?= set_value('id_ban', $id_ban); ?>" name="id_ban" id="id_ban"
                            type="text" class="form-control" placeholder="ID Ban...">
                        <?= form_error('id_ban', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="merk">Merk Ban</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('merk'); ?>" name="merk" id="merk" type="text" class="form-control"
                            placeholder="Merk Ban...">
                        <?= form_error('merk', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="type">Jenis Ban</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="type" id="type" class="custom-select">
                                <option value="" selected disabled>Pilih Jenis Ban</option>
                                <option value="Vulkanisir">Vulkanisir</option>
                                <option value="ORI">ORI</option>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-primary" href="<?= base_url('jenis/tambah'); ?>"><i
                                        class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('type', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="ukuran">Ukuran</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('ukuran'); ?>" name="ukuran" id="ukuran" type="number"
                            class="form-control" placeholder="Ukuran Ban...">
                        <?= form_error('ukuran', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="supplier_id">Supplier</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="supplier_id" id="supplier_id" class="custom-select">
                                <option value="" selected disabled>Pilih Supplier</option>
                                <?php foreach ($supplier as $s) : ?>
                                <option <?= set_select('supplier_id', $s['id_supplier']) ?>
                                    value="<?= $s['id_supplier'] ?>"><?= $s['nama_supplier'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-primary" href="<?= base_url('supplier/tambah'); ?>"><i
                                        class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('supplier_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="harga">Harga</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('harga'); ?>" name="harga" id="harga" type="text"
                            class="form-control" placeholder="Harga Ban...">
                        <?= form_error('harga', '<small class="text-danger">', '</small>'); ?>
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