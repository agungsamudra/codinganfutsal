<?php $this->load->view('template/header'); ?>

<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Ubah Status Pemesanan</h3>
    </div>
    <?php echo form_open('pemesanan/ubah/' . $pemesanan['id_pemesanan']); ?>
    <div class="box-body">
        <table class="table">
            <tr>
                <td width="150">Kode</td>
                <td><?php echo $pemesanan['kode_pemesanan']; ?></td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td><?php echo date('d-m-Y', strtotime($pemesanan['tanggal'])); ?></td>
            </tr>
            <tr>
                <td>Pemesan</td>
                <td><?php echo $pemesanan['nama_pemesan']; ?></td>
            </tr>
            <tr>
                <td>Lapangan</td>
                <td><?php echo $pemesanan['nama_lapangan']; ?></td>
            </tr>
            <tr>
                <td>Tgl Booking</td>
                <td><?php echo date('d-m-Y', strtotime($pemesanan['tgl_booking'])) . ' jam ' . $pemesanan['jam_booking']; ?></td>
            </tr>
            <tr>
                <td>Total</td>
                <td><?php echo number_format($pemesanan['total'], 0, ',', '.') . ' (DP: ' . number_format($pemesanan['dp'], 0, ',', '.') . ')'; ?></td>
            </tr>
            <tr>
                <td>Bukti Transfer</td>
                <td>
                    <?php if (!empty($pemesanan['file'])) : ?>
                        <a href="<?php echo base_url($pemesanan['file']); ?>" class="btn btn-primary btn-sm" title="Lihat Bukti Transfer" target="_blank"><i class="fa fa-search"></i> Bukti Transfer</a>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <select class="form-control" name="status" id="status" required>
                        <option value="">Pilih...</option>
                        <option value="Belum Lunas" <?php echo set_select('status', 'Belum Lunas', $pemesanan['status'] == 'Belum Lunas' ? TRUE : FALSE); ?>>Belum Lunas</option>
                        <option value="Lunas" <?php echo set_select('status', 'Lunas', $pemesanan['status'] == 'Lunas' ? TRUE : FALSE); ?>>Lunas</option>
                        <option value="Batal" <?php echo set_select('status', 'Batal', $pemesanan['status'] == 'Batal' ? TRUE : FALSE); ?>>Batal</option>
                    </select>
                </td>
            </tr>
        </table>
    </div>
    <div class="box-footer">
        <div class="col-md-offset-2">
            <button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
            <a href="<?php echo base_url('pemesanan'); ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>

<?php $this->load->view('template/footer'); ?>