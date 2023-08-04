<?php $this->load->view('template/header'); ?>

<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Detail Data</h3>
        <div class="box-tools">
            <a href="<?php echo base_url('lapangan'); ?>" class="btn btn-default btm-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </div>
    <div class="box-body">
        <table class="table">
            <tr>
                <td width="150">Nama Lapangan</td>
                <td><?= $lapangan['nama_lapangan'] ?></td>
            </tr>
            <tr>
                <td>Harga Sewa</td>
                <td><?= number_format($lapangan['harga_sewa'], 0, ',', '.') . '/jam' ?></td>
            </tr>
            <tr>
                <td>Kontak</td>
                <td><?= $lapangan['kontak'] ?></td>
            </tr>
            <tr>
                <td>Foto</td>
                <td>
                    <?php if (!empty($lapangan['foto'])) : ?>
                        <img src="<?php echo base_url('assets/images/lapangan/' . $lapangan['foto']) ?>" alt="Foto Lapangan" class="img-thumbnail" width="250">
                    <?php endif; ?>
                </td>
            </tr>
        </table>

        <h3>Jadwal Lapangan</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="100">No</th>
                    <th>Jam</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1 ?>
                <?php foreach ($jadwal as $row) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['jam']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php $this->load->view('template/footer'); ?>