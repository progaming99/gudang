<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Tambah Perbaikan Armada
                        </h4>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <?= form_open('', [], ['user_id' => $this->session->userdata('login_session')['user']]); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="tgl_laporan">Tanggal Laporan</label>
                    <div class="col-md-9">
                        <?php
                            // Mendapatkan tanggal dalam format "tanggal bulan tahun" (d F Y)
                            $tgl_laporan_value = set_value('tgl_laporan', date('Y-m-d'));
                            $tgl_laporan_display = date('d F Y', strtotime($tgl_laporan_value));
                        ?>
                        <input value="<?= $tgl_laporan_value; ?>" name="tgl_laporan" id="tgl_laporan" type="date"
                            class="form-control">
                        <small class="text-muted"><?= $tgl_laporan_display; ?></small>
                        <?= form_error('tgl_laporan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="armada_id">Armada</label>
                    <div class="col-md-9">
                        <div class="input-group">

                            <select name="armada_id" id="armada_id" class="custom-select">
                                <option selected disabled>Pilih Armada</option>
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
                    <label class="col-md-3 text-md-right" for="crew_id">Nama Kru</label>
                    <div class="col-md-9">
                        <div class="input-group">

                            <select name="crew_id" id="crew_id" class="custom-select">
                                <option selected disabled>Pilih Kru</option>
                                <?php foreach ($crew as $ar) : ?>
                                <option
                                    <?= set_select('crew_id', $ar['id_crew'], isset($_POST['crew_id']) && $_POST['crew_id'] == $ar['id_crew']) ?>
                                    value="<?= $ar['id_crew'] ?>">
                                    <?= $ar['nama_crew'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>

                            <div class="input-group-append">
                                <a class="btn btn-primary" href="<?= base_url('kru/tambah'); ?>"><i
                                        class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('crew_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="jenis_kerusakan">Jenis Kerusakan</label>
                    <div class="col-md-9">
                        <input id="jenis_kerusakan" name="jenis_kerusakan" type="text" class="form-control"
                            placeholder="Jenis Kerusakan" value="<?= set_value('jenis_kerusakan'); ?>">
                        <?= form_error('jenis_kerusakan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="tgl_masuk">Tgl Masuk Bengkel</label>
                    <div class="col-md-9">
                        <input name="tgl_masuk" value="<?= set_value('tgl_masuk'); ?>" id="tgl_masuk" type="date"
                            class="form-control">
                        <?= form_error('tgl_masuk', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="tgl_pengerjaan">Tgl Mulai Pengerjaan</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('tgl_pengerjaan'); ?>" name="tgl_pengerjaan" id="tgl_pengerjaan"
                            type="date" class="form-control">
                        <?= form_error('tgl_pengerjaan', '<small class="text-danger">', '</small>'); ?>
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
                    <label class="col-md-3 text-md-right" for="level_kebutuhan_id">Level Kebutuhan Armada</label>
                    <div class="col-md-9">
                        <div class="input-group">

                            <select name="level_kebutuhan_id" id="level_kebutuhan_id" class="custom-select">
                                <option selected disabled>Pilih Level</option>
                                <?php foreach ($level_kebutuhan as $ar) : ?>
                                <option
                                    <?= set_select('level_kebutuhan_id', $ar['id_level_kebutuhan'], isset($_POST['level_kebutuhan_id']) && $_POST['level_kebutuhan_id'] == $ar['id_level_kebutuhan']) ?>
                                    value="<?= $ar['id_level_kebutuhan'] ?>">
                                    <?= $ar['nama_level'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?= form_error('level_kebutuhan_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="progress">Tindakan Hari Ini</label>
                    <div class="col-md-9">
                        <input id="progress" name="progress" value="<?= set_value('progress'); ?>" type="text"
                            class="form-control" placeholder="Progress">
                        <?= form_error('progress', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="tahapan">Sudah Berapa Langkah</label>
                    <div class="col-md-9">
                        <input id="tahapan" name="tahapan" value="<?= set_value('tahapan'); ?>" type="number"
                            class="form-control" min="0">
                        <?= form_error('tahapan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="masalah">Tunda Proses</label>
                    <div class="col-md-9">
                        <input id="masalah" name="masalah" value="<?= set_value('masalah'); ?>" type="text"
                            class="form-control" placeholder="Masalah ditemukan">
                        <?= form_error('masalah', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="rencana_selesai">Rencana Selesai</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('rencana_selesai'); ?>" name="rencana_selesai" id="rencana_selesai"
                            type="date" class="form-control">
                        <?= form_error('rencana_selesai', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="tgl_selesai">Tgl Selesai</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('tgl_selesai'); ?>" name="tgl_selesai" id="tgl_selesai" type="date"
                            class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="lama_pengerjaan">Lama Pengerjaan</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input value="<?= set_value('lama_pengerjaan'); ?>" name="lama_pengerjaan"
                                id="lama_pengerjaan" type="number" class="form-control" min="1">
                            <div class="input-group-append">
                                <span class="input-group-text">Hari</span>
                            </div>
                        </div>
                        <?= form_error('lama_pengerjaan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="status">Status</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="status" id="status" class="custom-select">
                                <option value="" selected disabled>Pilih Status</option>
                                <option
                                    <?= set_select('status', 'Selesai', isset($_POST['status']) && $_POST['status'] == 'Selesai') ?>
                                    value="Selesai">Selesai</option>
                                <option
                                    <?= set_select('status', 'Belum Selesai', isset($_POST['status']) && $_POST['status'] == 'Belum Selesai') ?>
                                    value="Belum Selesai">Belum Selesai</option>
                            </select>
                        </div>
                        <?= form_error('status', '<small class="text-danger">', '</small>'); ?>
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