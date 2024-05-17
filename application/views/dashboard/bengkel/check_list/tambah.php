<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Tambah Check List Armada
                        </h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= form_open('', [], ['user_id' => $this->session->userdata('login_session')['user']]); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="tanggal">Tanggal Laporan</label>
                    <div class="col-md-9">
                        <?php
                            // Mendapatkan tanggal dalam format "tanggal bulan tahun" (d F Y)
                            $tgl_value = set_value('tanggal', date('Y-m-d'));
                            $tgl_display = date('d F Y', strtotime($tgl_value));
                        ?>
                        <input value="<?= $tgl_value; ?>" name="tanggal" type="date" class="form-control">
                        <?= form_error('tanggal', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="armada_id">Armada</label>
                    <div class="col-md-9">
                        <div class="input-group">

                            <select name="armada_id" id="armada_id" class="custom-select">
                                <option value="" selected disabled>Pilih Armada</option>
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
                    <label class="col-md-3 text-md-right" for="supir_id">Supir</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="supir_id" id="supir_id" class="custom-select">
                                <option value="" selected disabled>Pilih Supir</option>
                                <?php foreach ($supir as $ar) : ?>
                                <option
                                    <?= set_select('supir_id', $ar['id_supir'], isset($_POST['supir_id']) && $_POST['supir_id'] == $ar['id_supir']) ?>
                                    value="<?= $ar['id_supir'] ?>">
                                    <?= $ar['nama_supir'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-primary" href="<?= base_url('supir/tambah'); ?>"><i
                                        class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('supir_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="kernet_id">Kernet</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="kernet_id" id="kernet_id" class="custom-select">
                                <option value="" selected disabled>Pilih Kernet</option>
                                <?php foreach ($kernet as $ar) : ?>
                                <option
                                    <?= set_select('kernet_id', $ar['id_kernet'], isset($_POST['kernet_id']) && $_POST['kernet_id'] == $ar['id_kernet']) ?>
                                    value="<?= $ar['id_kernet'] ?>">
                                    <?= $ar['nama_kernet'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-primary" href="<?= base_url('kernet/tambah'); ?>"><i
                                        class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('kernet_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="kebersihan_armada">Kebersihan Armada</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="kebersihan_armada" id="kebersihan_armada" class="custom-select">
                                <option value="" selected disabled>Pilih</option>
                                <option
                                    <?= set_select('kebersihan_armada', 'OK', isset($_POST['kebersihan_armada']) && $_POST['kebersihan_armada'] == 'OK') ?>
                                    value="OK">OK</option>
                                <option
                                    <?= set_select('kebersihan_armada', 'NO', isset($_POST['kebersihan_armada']) && $_POST['kebersihan_armada'] == 'NO') ?>
                                    value="NO">NO</option>
                            </select>
                        </div>
                        <?= form_error('kebersihan_armada', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="kelayakan_box">Kelayakan Box</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="kelayakan_box" id="kelayakan_box" class="custom-select">
                                <option value="" selected disabled>Pilih</option>
                                <option
                                    <?= set_select('kelayakan_box', 'OK', isset($_POST['kelayakan_box']) && $_POST['kelayakan_box'] == 'OK') ?>
                                    value="OK">OK</option>
                                <option
                                    <?= set_select('kelayakan_box', 'NO', isset($_POST['kelayakan_box']) && $_POST['kelayakan_box'] == 'NO') ?>
                                    value="NO">NO</option>
                            </select>
                        </div>
                        <?= form_error('kelayakan_box', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="tekanan_ban_depan">Tekanan Ban Depan</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="tekanan_ban_depan" id="tekanan_ban_depan" class="custom-select">
                                <option value="" selected disabled>Pilih</option>
                                <option
                                    <?= set_select('tekanan_ban_depan', 'OK', isset($_POST['tekanan_ban_depan']) && $_POST['tekanan_ban_depan'] == 'OK') ?>
                                    value="OK">OK</option>
                                <option
                                    <?= set_select('tekanan_ban_depan', 'NO', isset($_POST['tekanan_ban_depan']) && $_POST['tekanan_ban_depan'] == 'NO') ?>
                                    value="NO">NO</option>
                            </select>
                        </div>
                        <?= form_error('tekanan_ban_depan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="tekanan_ban_belakang_1">Tekanan Ban Belakang</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="tekanan_ban_belakang_1" id="tekanan_ban_belakang_1" class="custom-select">
                                <option value="" selected disabled>Pilih</option>
                                <option
                                    <?= set_select('tekanan_ban_belakang_1', 'OK', isset($_POST['tekanan_ban_belakang_1']) && $_POST['tekanan_ban_belakang_1'] == 'OK') ?>
                                    value="OK">OK</option>
                                <option
                                    <?= set_select('tekanan_ban_belakang_1', 'NO', isset($_POST['tekanan_ban_belakang_1']) && $_POST['tekanan_ban_belakang_1'] == 'NO') ?>
                                    value="NO">NO</option>
                            </select>
                        </div>
                        <?= form_error('tekanan_ban_belakang_1', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="tekanan_ban_belakang_2">Tekanan Ban Belakang 2</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="tekanan_ban_belakang_2" id="tekanan_ban_belakang_2" class="custom-select">
                                <option value="" selected disabled>Pilih</option>
                                <option
                                    <?= set_select('tekanan_ban_belakang_2', 'OK', isset($_POST['tekanan_ban_belakang_2']) && $_POST['tekanan_ban_belakang_2'] == 'OK') ?>
                                    value="OK">OK</option>
                                <option
                                    <?= set_select('tekanan_ban_belakang_2', 'NO', isset($_POST['tekanan_ban_belakang_2']) && $_POST['tekanan_ban_belakang_2'] == 'NO') ?>
                                    value="NO">NO</option>
                            </select>
                        </div>
                        <?= form_error('tekanan_ban_belakang_2', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="lampu_utama">Lampu Utama</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="lampu_utama" id="lampu_utama" class="custom-select">
                                <option value="" selected disabled>Pilih</option>
                                <option
                                    <?= set_select('lampu_utama', 'OK', isset($_POST['lampu_utama']) && $_POST['lampu_utama'] == 'OK') ?>
                                    value="OK">OK</option>
                                <option
                                    <?= set_select('lampu_utama', 'NO', isset($_POST['lampu_utama']) && $_POST['lampu_utama'] == 'NO') ?>
                                    value="NO">NO</option>
                            </select>
                        </div>
                        <?= form_error('lampu_utama', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="lampu_kota">Lampu Kota</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="lampu_kota" id="lampu_kota" class="custom-select">
                                <option value="" selected disabled>Pilih</option>
                                <option
                                    <?= set_select('lampu_kota', 'OK', isset($_POST['lampu_kota']) && $_POST['lampu_kota'] == 'OK') ?>
                                    value="OK">OK</option>
                                <option
                                    <?= set_select('lampu_kota', 'NO', isset($_POST['lampu_kota']) && $_POST['lampu_kota'] == 'NO') ?>
                                    value="NO">NO</option>
                            </select>
                        </div>
                        <?= form_error('lampu_kota', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="lampu_sein">Lampu Sein</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="lampu_sein" id="lampu_sein" class="custom-select">
                                <option value="" selected disabled>Pilih</option>
                                <option
                                    <?= set_select('lampu_sein', 'OK', isset($_POST['lampu_sein']) && $_POST['lampu_sein'] == 'OK') ?>
                                    value="OK">OK</option>
                                <option
                                    <?= set_select('lampu_sein', 'NO', isset($_POST['lampu_sein']) && $_POST['lampu_sein'] == 'NO') ?>
                                    value="NO">NO</option>
                            </select>
                        </div>
                        <?= form_error('lampu_sein', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="level_oli">Level Oli</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="level_oli" id="level_oli" class="custom-select">
                                <option value="" selected disabled>Pilih</option>
                                <option
                                    <?= set_select('level_oli', 'OK', isset($_POST['level_oli']) && $_POST['level_oli'] == 'OK') ?>
                                    value="OK">OK</option>
                                <option
                                    <?= set_select('level_oli', 'NO', isset($_POST['level_oli']) && $_POST['level_oli'] == 'NO') ?>
                                    value="NO">NO</option>
                            </select>
                        </div>
                        <?= form_error('level_oli', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="level_aki">Level Aki</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="level_aki" id="level_aki" class="custom-select">
                                <option value="" selected disabled>Pilih</option>
                                <option
                                    <?= set_select('level_aki', 'OK', isset($_POST['level_aki']) && $_POST['level_aki'] == 'OK') ?>
                                    value="OK">OK</option>
                                <option
                                    <?= set_select('level_aki', 'NO', isset($_POST['level_aki']) && $_POST['level_aki'] == 'NO') ?>
                                    value="NO">NO</option>
                            </select>
                        </div>
                        <?= form_error('level_aki', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="kelayakan_ban">Kelayakan Ban</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="kelayakan_ban" id="kelayakan_ban" class="custom-select">
                                <option value="" selected disabled>Pilih</option>
                                <option
                                    <?= set_select('kelayakan_ban', 'OK', isset($_POST['kelayakan_ban']) && $_POST['kelayakan_ban'] == 'OK') ?>
                                    value="NO">30%</option>
                                <option
                                    <?= set_select('kelayakan_ban', 'NO', isset($_POST['kelayakan_ban']) && $_POST['kelayakan_ban'] == 'NO') ?>
                                    value="NO">50%</option>
                                <option
                                    <?= set_select('kelayakan_ban', 'OK', isset($_POST['kelayakan_ban']) && $_POST['kelayakan_ban'] == 'OK') ?>
                                    value="OK">80% - 100%</option>
                            </select>
                        </div>
                        <?= form_error('kelayakan_ban', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="catatan">catatan</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input value="<?= set_value('catatan'); ?>" placeholder="Sparepart belum ada" name="catatan"
                                id="catatan" type="text" class="form-control">
                        </div>
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