<?php $this->load->view('template/header'); ?>

<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Ubah Data</h3>
    </div>
    <?php echo form_open('jadwal/ubah/' . $id_lapangan . '/' . $jadwal['id_jadwal']); ?>
    <div class="box-body">
        <?php echo $this->session->flashdata('success'); ?>
        <div class="form-horizontal">
            <div class="form-group">
                <label for="jam" class="col-md-2 control-label">Jam</label>
                <div class="col-md-2">
                    <input name="jam" id="jam" type="time" class="form-control" value="<?php echo set_value('jam', $jadwal['jam']); ?>">
                    <span class="text-danger"><?php echo form_error('jam'); ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <div class="col-md-offset-2">
            <button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
            <a href="<?php echo base_url('jadwal/' . $id_lapangan); ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>

<?php $this->load->view('template/footer'); ?>