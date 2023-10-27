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
                <?= form_open(); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="nomor_armada">Nomor Armada</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input value="<?= set_value('nomor_armada'); ?>" name="nomor_armada" id="nomor_armada"
                                type="text" class="form-control" placeholder="">
                        </div>

                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="nama_supir">Nama Supir</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input value="<?= set_value('nama_supir'); ?>" name="nama_supir" id="nama_supir" type="text"
                                class="form-control" placeholder="">
                        </div>
                        <?= form_error('nama_supir', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="tanggal_pasang">Tanggal Pasang</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input value="<?= set_value('tanggal_pasang'); ?>" name="tanggal_pasang" id="tanggal_pasang"
                                type="date" class="form-control" placeholder="">
                        </div>

                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="tanggal_ganti">Tanggal Ganti</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input value="<?= set_value('tanggal_ganti'); ?>" name="tanggal_ganti" id="tanggal_ganti"
                                type="date" class="form-control" placeholder="">
                        </div>

                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="rencana_ganti">Rencana Ganti</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input value="<?= set_value('rencana_ganti'); ?>" name="rencana_ganti" id="rencana_ganti"
                                type="date" class="form-control" placeholder="">
                        </div>

                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="km_pasang">KM Pasang</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input value="<?= set_value('km_pasang'); ?>" name="km_pasang" id="km_pasang" type="number"
                                class="form-control" placeholder="">
                        </div>

                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="km_ganti">KM Ganti</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input value="<?= set_value('km_ganti'); ?>" name="km_ganti" id="km_ganti" type="number"
                                class="form-control" placeholder="">
                        </div>

                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="nomor_posisi">Nomor Posisi Ban</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select class="form-select" aria-label="Default select example" for="nomor_posisi"
                                id="nomor_posisi" name="nomor_posisi">
                                <option selected>Pilih Nomor Ban</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="merk">Merk Ban</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input value="<?= set_value('merk'); ?>" name="merk" id="merk" type="text"
                                class="form-control" placeholder="">
                        </div>

                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="type">Type Ban</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select class="form-select" aria-label="Default select example" for="type" id="type"
                                name="type">
                                <option selected>Pilih Type Ban</option>
                                <option value="Vulkanisir">Vulkanisir</option>
                                <option value="ORI">ORI</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="ukuran">Ukuran Ban</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input value="<?= set_value('ukuran'); ?>" name="ukuran" id="ukuran" type="number"
                                class="form-control" placeholder="">
                        </div>

                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="nomor_seri_baru">Nomor Seri Baru</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input value="<?= set_value('nomor_seri_baru'); ?>" name="nomor_seri_baru"
                                id="nomor_seri_baru" type="text" class="form-control" placeholder="">
                        </div>

                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="nomor_seri_lama">Nomor Seri Lama</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input value="<?= set_value('nomor_seri_lama'); ?>" name="nomor_seri_lama"
                                id="nomor_seri_lama" type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="keterangan">Keterangan</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select class="form-select" aria-label="Default select example" for="keterangan"
                                id="keterangan" name="keterangan">
                                <option selected>Pilih Keterangan</option>
                                <option value="OK">OK</option>
                                <option value="NOT">Not</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="harga">Harga</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input value="<?= set_value('harga'); ?>" name="harga" id="harga" type="number"
                                class="form-control" placeholder="">
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