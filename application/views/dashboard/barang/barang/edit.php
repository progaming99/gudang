<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Edit Sparepart
                        </h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= form_open('', [], ['stok' => 0, 'id_barang' => $barang['id_barang']]); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="nama_barang">Nama</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('nama_barang', $barang['nama_barang']); ?>" name="nama_barang"
                            id="nama_barang" type="text" class="form-control" placeholder="Nama Barang...">
                        <?= form_error('nama_barang', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="jenis_id">Jenis</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="jenis_id" id="jenis_id" class="custom-select">
                                <option value="" selected disabled>Pilih Jenis Barang</option>
                                <?php foreach ($jenis as $j) : ?>
                                <option <?= $barang['jenis_id'] == $j['id_jenis'] ? 'selected' : ''; ?>
                                    <?= set_select('jenis_id', $j['id_jenis']) ?> value="<?= $j['id_jenis'] ?>">
                                    <?= $j['nama_jenis'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-primary" href="<?= base_url('jenis/tambah'); ?>"><i
                                        class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('jenis_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="supplier_id">Supplier</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="supplier_id" id="supplier_id" class="custom-select">
                                <option value="" selected disabled>Pilih Supplier</option>
                                <?php foreach ($supplier as $j) : ?>
                                <option <?= $barang['supplier_id'] == $j['id_supplier'] ? 'selected' : ''; ?>
                                    <?= set_select('supplier_id', $j['id_supplier']) ?>
                                    value="<?= $j['id_supplier'] ?>">
                                    <?= $j['nama_supplier'] ?></option>
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
                        <input value="<?= set_value('harga', $barang['harga']); ?>" name="harga" id="harga"
                            type="number" class="form-control">
                        <?= form_error('harga', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="satuan_id">Satuan</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="satuan_id" id="satuan_id" class="custom-select">
                                <option value="" selected disabled>Pilih Satuan Barang</option>
                                <?php foreach ($satuan as $s) : ?>
                                <option <?= $barang['satuan_id'] == $s['id_satuan'] ? 'selected' : ''; ?>
                                    <?= set_select('satuan_id', $s['id_satuan']) ?> value="<?= $s['id_satuan'] ?>">
                                    <?= $s['nama_satuan'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-primary" href="<?= base_url('satuan/tambah'); ?>"><i
                                        class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('satuan_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="stok">Stok</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('stok', $barang['stok']); ?>" name="stok" id="stok" type="number"
                            class="form-control" readonly>
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