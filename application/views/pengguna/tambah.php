<?php $this->load->view('template/header'); ?>

<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Tambah Data</h3>
    </div>
    <?php echo form_open('pengguna/tambah'); ?>
    <div class="box-body">
        <?php echo $this->session->flashdata('success'); ?>
        <div class="form-horizontal">
            <div class="form-group">
                <label for="nama_lengkap" class="col-md-2 control-label">Nama Lengkap</label>
                <div class="col-md-10">
                    <input name="nama_lengkap" id="nama_lengkap" type="text" class="form-control" value="<?php echo set_value('nama_lengkap'); ?>">
                    <span class="text-danger"><?php echo form_error('nama_lengkap'); ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="col-md-2 control-label">Username</label>
                <div class="col-md-10">
                    <input name="username" id="username" type="text" class="form-control" value="<?php echo set_value('username'); ?>">
                    <span class="text-danger"><?php echo form_error('username'); ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-2 control-label">Password</label>
                <div class="col-md-10">
                    <input name="password" id="password" type="password" class="form-control" value="<?php echo set_value('password'); ?>">
                    <span class="text-danger"><?php echo form_error('password'); ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="level" class="col-md-2 control-label">Level</label>
                <div class="col-md-10">
                    <select class="form-control" name="level" id="level">
                        <option value="">Pilih...</option>
                        <option value="Admin" <?php echo set_value('level') == 'Admin' ? 'selected' : ''; ?>>Admin</option>
                        <option value="Pemilik" <?php echo set_value('level') == 'Pemilik' ? 'selected' : ''; ?>>Pemilik</option>
                    </select>
                    <span class="text-danger"><?php echo form_error('level'); ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <div class="col-md-offset-2">
            <button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
            <a href="<?php echo base_url('pengguna'); ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>

<?php $this->load->view('template/footer'); ?>