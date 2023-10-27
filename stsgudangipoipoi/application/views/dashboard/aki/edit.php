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
                <form action="" method="post">
                    <input type="hidden" name="id_aki" value="<?= $aki->id_aki; ?>">
                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="nomor_armada">Nomor Armada</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input value="<?= $aki->nomor_armada; ?>" name="nomor_armada" id="nomor_armada"
                                    type="text" class="form-control" placeholder="">
                            </div>
                            <?= form_error('nomor_armada', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="nama_supir">Nama Supir</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input value="<?= $aki->nama_supir; ?>" name="nama_supir" id="nama_supir" type="text"
                                    class="form-control" placeholder="">
                            </div>
                            <?= form_error('nama_supir', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="tanggal_pasang_baru">Tanggal Pasang Baru</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input value="<?= $aki->tanggal_pasang_baru; ?>" name="tanggal_pasang_baru"
                                    id="tanggal_pasang_baru" type="date" class="form-control" placeholder="">
                            </div>
                            <?= form_error('tanggal_pasang_baru', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="tanggal_pasang_lama">Tanggal Pasang Lama</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input value="<?= $aki->tanggal_pasang_lama; ?>" name="tanggal_pasang_lama"
                                    id="tanggal_pasang_lama" type="date" class="form-control" placeholder="">
                            </div>
                            <?= form_error('tanggal_pasang_lama', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="lama_pemakaian_hari">Lama Pemakaian (Hari)</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input value="<?= $aki->lama_pemakaian_hari; ?>" name="lama_pemakaian_hari"
                                    id="lama_pemakaian_hari" type="number" class="form-control" placeholder="">
                            </div>
                            <?= form_error('lama_pemakaian_hari', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="lama_pemakaian_tahun">Lama Pemakaian (Tahun)</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input value="<?= $aki->lama_pemakaian_tahun; ?>" name="lama_pemakaian_tahun"
                                    id="lama_pemakaian_tahun" type="number" class="form-control" placeholder="">
                            </div>
                            <?= form_error('lama_pemakaian_tahun', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="masalah">Masalah</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input value="<?= $aki->masalah; ?>" name="masalah" id="masalah" type="text"
                                    class="form-control" placeholder="">
                            </div>
                            <?= form_error('masalah', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="keterangan">Keterangan</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input value="<?= $aki->keterangan; ?>" name="keterangan" id="keterangan" type="text"
                                    class="form-control" placeholder="">
                            </div>
                            <?= form_error('keterangan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary me-md-2" type="submit" name="tambah">Edit Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>