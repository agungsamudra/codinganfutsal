<?php $this->load->view('template/header'); ?>

<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Laporan Pendapatan</h3>
    </div>
    <div class="box-body">
        <?php echo form_open('laporan', array('id' => 'form_laporan')); ?>
        <div class="form-horizontal">
            <div class="col-sm-1">
                <label for="tgl1" class="control-label">Periode</label>
            </div>
            <div class="col-sm-2">
                <input name="tgl1" id="tgl1" required placeholder="Dari tanggal" autocomplete="off" class="form-control datepicker2" type="text" value="<?php echo set_value('tgl1'); ?>">
            </div>
            <div class="col-sm-2">
                <input name="tgl2" id="tgl2" required placeholder="Sampai tanggal" autocomplete="off" class="form-control datepicker2" type="text" value="<?php echo set_value('tgl2'); ?>">
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Tampilkan</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<div id='result'></div>

<script>
    $(document).ready(function() {
        $('#form_laporan').submit(function(e) {
            e.preventDefault();
            var tgl1 = $('#tgl1').val();
            var tgl2 = $('#tgl2').val();
            var url = "<?php echo site_url('laporan/lihat'); ?>/" + tgl1 + "/" + tgl2;
            $('#result').load(url);
        });
    });
</script>

<?php $this->load->view('template/footer'); ?>