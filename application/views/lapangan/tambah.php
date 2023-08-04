<?php $this->load->view('template/header'); ?>

<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Tambah Data</h3>
    </div>
    <?php echo form_open_multipart('lapangan/tambah'); ?>
    <div class="box-body">
        <?php echo $this->session->flashdata('success'); ?>
        <div class="form-horizontal">
            <div class="form-group">
                <label for="nama_lapangan" class="col-md-2 control-label">Nama Lapangan</label>
                <div class="col-md-10">
                    <input name="nama_lapangan" id="nama_lapangan" type="text" class="form-control" value="<?php echo set_value('nama_lapangan'); ?>">
                    <span class="text-danger"><?php echo form_error('nama_lapangan'); ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="harga_sewa" class="col-md-2 control-label">Harga Sewa</label>
                <div class="col-md-10">
                    <input name="harga_sewa" id="harga_sewa" type="number" class="form-control" value="<?php echo set_value('harga_sewa'); ?>">
                    <span class="text-danger"><?php echo form_error('harga_sewa'); ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="kontak" class="col-md-2 control-label">Kontak</label>
                <div class="col-md-10">
                    <input name="kontak" id="kontak" type="text" class="form-control" value="<?php echo set_value('kontak'); ?>">
                    <span class="text-danger"><?php echo form_error('kontak'); ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="foto" class="col-md-2 control-label">Foto</label>
                <div class="col-md-10">
                    <input name="foto" id="foto" type="file" class="form-control">
                    <span class="text-danger"><?php echo form_error('foto'); ?></span>
                    <small>Ukuran foto maksimal 2 MB. Tipe file yang diijinkan (JPG,JPEG,PNG).</small>
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <div class="col-md-offset-2">
            <button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
            <a href="<?php echo base_url('lapangan'); ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>

<?php $this->load->view('template/footer'); ?>