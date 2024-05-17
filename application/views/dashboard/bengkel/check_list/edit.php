<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Edit Check List Armada
                        </h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= form_open('', [], ['id_check_list' => $check_list['id_check_list']]); ?>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="tanggal">Tanggal Laporan</label>
                    <div class="col-md-9">
                        <input value="<?= $check_list['tanggal']; ?>" name="tanggal" type="date" class="form-control">
                        <!-- <small class="text-muted"><?= $tgl_display; ?></small> -->
                        <?= form_error('tanggal', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="armada_id">Armada</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="armada_id" id="armada_id" class="custom-select">
                                <option value="" disabled>Pilih Armada</option>
                                <?php foreach ($armada as $ar) : ?>
                                <option <?= $check_list['armada_id'] == $ar['id_armada'] ? 'selected' : ''; ?>
                                    <?= set_select('armada_id', $ar['id_armada']) ?> value="<?= $ar['id_armada'] ?>">
                                    <?= $ar['nama_armada'] ?></option>
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
                                <option <?= $check_list['supir_id'] == $ar['id_supir'] ? 'selected' : ''; ?>
                                    <?= set_select('supir_id', $ar['id_supir']) ?> value="<?= $ar['id_supir'] ?>">
                                    <?= $ar['nama_supir'] ?></option>
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
                                <option <?= $check_list['kernet_id'] == $ar['id_kernet'] ? 'selected' : ''; ?>
                                    <?= set_select('kernet_id', $ar['id_kernet']) ?> value="<?= $ar['id_kernet'] ?>">
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
                                <?php foreach ($kondisi as $sts) : ?>
                                <?php if ($sts == $check_list['kebersihan_armada']) : ?>
                                <option value="<?= $sts; ?>" selected><?= $sts; ?></option>
                                <?php else : ?>
                                <option value="<?= $sts ?>"><?= $sts; ?></option>
                                <?php endif; ?>
                                <?php endforeach; ?>
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
                                <?php foreach ($kondisi as $sts) : ?>
                                <?php if ($sts == $check_list['kelayakan_box']) : ?>
                                <option value="<?= $sts; ?>" selected><?= $sts; ?></option>
                                <?php else : ?>
                                <option value="<?= $sts ?>"><?= $sts; ?></option>
                                <?php endif; ?>
                                <?php endforeach; ?>
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
                                <?php foreach ($kondisi as $sts) : ?>
                                <?php if ($sts == $check_list['tekanan_ban_depan']) : ?>
                                <option value="<?= $sts; ?>" selected><?= $sts; ?></option>
                                <?php else : ?>
                                <option value="<?= $sts ?>"><?= $sts; ?></option>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?= form_error('tekanan_ban_depan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="tekanan_ban_belakang_1">Tekanan Ban Belakang 1</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="tekanan_ban_belakang_1" id="tekanan_ban_belakang_1" class="custom-select">
                                <option value="" selected disabled>Pilih</option>
                                <?php foreach ($kondisi as $sts) : ?>
                                <?php if ($sts == $check_list['tekanan_ban_belakang_1']) : ?>
                                <option value="<?= $sts; ?>" selected><?= $sts; ?></option>
                                <?php else : ?>
                                <option value="<?= $sts ?>"><?= $sts; ?></option>
                                <?php endif; ?>
                                <?php endforeach; ?>
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
                                <?php foreach ($kondisi as $sts) : ?>
                                <?php if ($sts == $check_list['tekanan_ban_belakang_2']) : ?>
                                <option value="<?= $sts; ?>" selected><?= $sts; ?></option>
                                <?php else : ?>
                                <option value="<?= $sts ?>"><?= $sts; ?></option>
                                <?php endif; ?>
                                <?php endforeach; ?>
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
                                <?php foreach ($kondisi as $sts) : ?>
                                <?php if ($sts == $check_list['lampu_utama']) : ?>
                                <option value="<?= $sts; ?>" selected><?= $sts; ?></option>
                                <?php else : ?>
                                <option value="<?= $sts ?>"><?= $sts; ?></option>
                                <?php endif; ?>
                                <?php endforeach; ?>
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
                                <?php foreach ($kondisi as $sts) : ?>
                                <?php if ($sts == $check_list['lampu_kota']) : ?>
                                <option value="<?= $sts; ?>" selected><?= $sts; ?></option>
                                <?php else : ?>
                                <option value="<?= $sts ?>"><?= $sts; ?></option>
                                <?php endif; ?>
                                <?php endforeach; ?>
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
                                <?php foreach ($kondisi as $sts) : ?>
                                <?php if ($sts == $check_list['lampu_sein']) : ?>
                                <option value="<?= $sts; ?>" selected><?= $sts; ?></option>
                                <?php else : ?>
                                <option value="<?= $sts ?>"><?= $sts; ?></option>
                                <?php endif; ?>
                                <?php endforeach; ?>
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
                                <?php foreach ($kondisi as $sts) : ?>
                                <?php if ($sts == $check_list['level_oli']) : ?>
                                <option value="<?= $sts; ?>" selected><?= $sts; ?></option>
                                <?php else : ?>
                                <option value="<?= $sts ?>"><?= $sts; ?></option>
                                <?php endif; ?>
                                <?php endforeach; ?>
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
                                <?php foreach ($kondisi as $sts) : ?>
                                <?php if ($sts == $check_list['level_aki']) : ?>
                                <option value="<?= $sts; ?>" selected><?= $sts; ?></option>
                                <?php else : ?>
                                <option value="<?= $sts ?>"><?= $sts; ?></option>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?= form_error('level_aki', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <?php
                    $data['ban'] = ['Tidak Layak', 'Tidak Layak', 'Layak'];
                    $data['ban2'] = ['30%', '50%', '80% - 100%'];
                ?>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="kelayakan_ban">Kelayakan Ban</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="kelayakan_ban" id="kelayakan_ban" class="custom-select">
                                <option value="" selected disabled>Pilih</option>
                                <?php foreach ($ban as $key => $sts) : ?>
                                <?php if ($sts == $check_list['kelayakan_ban']) : ?>
                                <option value="<?= $sts; ?>" selected><?= $ban2[$key]; ?></option>
                                <?php else : ?>
                                <option value="<?= $sts; ?>"><?= $ban2[$key]; ?></option>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?= form_error('kelayakan_ban', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="catatan">Catatan</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input value="<?= $check_list['catatan']; ?>" name="catatan" id="catatan" type="text"
                                class="form-control">
                        </div>
                        <?= form_error('catatan', '<small class="text-danger">', '</small>'); ?>
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