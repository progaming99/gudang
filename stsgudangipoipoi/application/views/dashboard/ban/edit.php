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
                <form action="" method="post">
                    <input type="hidden" name="id_ban" value="<?= $ban->id_ban; ?>">
                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="nomor_armada">Nomor Armada</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input value="<?= $ban->nomor_armada; ?>" name="nomor_armada" id="nomor_armada"
                                    type="text" class="form-control" placeholder="">
                            </div>
                            <?= form_error('nomor_armada', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="nama_supir">Nama Supir</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input value="<?= $ban->nama_supir; ?>" name="nama_supir" id="nama_supir" type="text"
                                    class="form-control" placeholder="">
                            </div>
                            <?= form_error('nama_supir', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="tanggal_pasang">Tanggal Pasang</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input value="<?= $ban->tanggal_pasang; ?>" name="tanggal_pasang" id="tanggal_pasang"
                                    type="date" class="form-control" placeholder="">
                            </div>
                            <?= form_error('tanggal_pasang', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="tanggal_ganti">Tanggal Ganti</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input value="<?= $ban->tanggal_ganti; ?>" name="tanggal_ganti" id="tanggal_ganti"
                                    type="date" class="form-control" placeholder="">
                            </div>
                            <?= form_error('tanggal_ganti', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="rencana_ganti">Rencana Ganti</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input value="<?= $ban->rencana_ganti; ?>" name="rencana_ganti" id="rencana_ganti"
                                    type="date" class="form-control" placeholder="">
                            </div>
                            <?= form_error('rencana_ganti', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="km_pasang">KM Pasang</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input value="<?= $ban->km_pasang; ?>" name="km_pasang" id="km_pasang" type="number"
                                    class="form-control" placeholder="">
                            </div>
                            <?= form_error('km_pasang', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="km_ganti">KM Ganti</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input value="<?= $ban->km_ganti; ?>" name="km_ganti" id="km_ganti" type="number"
                                    class="form-control" placeholder="">
                            </div>
                            <?= form_error('km_ganti', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="nomor_posisi">Nomor Posisi Ban</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <select class="form-select" aria-label="Default select example" for="nomor_posisi"
                                    id="nomor_posisi" name="nomor_posisi">
                                    <?php foreach ($posisi as $np) : ?>
                                    <?php if ($np == $ban->nomor_posisi) : ?>
                                    <option value="<?= $np; ?>" selected><?= $np; ?></option>
                                    <?php else : ?>
                                    <option value="<?= $np ?>"><?= $np; ?></option>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="merk">Merk Ban</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input value="<?= $ban->merk; ?>" name="merk" id="merk" type="text" class="form-control"
                                    placeholder="">
                            </div>
                            <?= form_error('merk', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="type">Type Ban</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <select class="form-select" aria-label="Default select example" for="type" id="type"
                                    name="type">
                                    <?php foreach ($type as $np) : ?>
                                    <?php if ($np == $ban->nomor_posisi) : ?>
                                    <option value="<?= $np; ?>" selected><?= $np; ?></option>
                                    <?php else : ?>
                                    <option value="<?= $np ?>"><?= $np; ?></option>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="ukuran">Ukuran Ban</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input value="<?= $ban->ukuran; ?>" name="ukuran" id="ukuran" type="number"
                                    class="form-control" placeholder="">
                            </div>
                            <?= form_error('ukuran', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="nomor_seri_baru">Nomor Seri Baru</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input value="<?= $ban->nomor_seri_baru; ?>" name="nomor_seri_baru" id="nomor_seri_baru"
                                    type="text" class="form-control" placeholder="">
                            </div>
                            <?= form_error('nomor_seri_baru', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="nomor_seri_lama">Nomor Seri Lama</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input value="<?= $ban->nomor_seri_lama; ?>" name="nomor_seri_lama" id="nomor_seri_lama"
                                    type="text" class="form-control" placeholder="">
                            </div>
                            <?= form_error('nomor_seri_lama', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="keterangan">Keterangan</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <select class="form-select" aria-label="Default select example" for="keterangan"
                                    id="keterangan" name="keterangan">
                                    <?php foreach ($keterangan as $np) : ?>
                                    <?php if ($np == $ban->nomor_posisi) : ?>
                                    <option value="<?= $np; ?>" selected><?= $np; ?></option>
                                    <?php else : ?>
                                    <option value="<?= $np ?>"><?= $np; ?></option>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="harga">Harga</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input value="<?= $ban->harga; ?>" name="harga" id="harga" type="number"
                                    class="form-control" placeholder="">
                            </div>
                            <?= form_error('harga', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>


                    <div class="row form-group">
                        <div class="col-md-9 offset-md-3">
                            <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>