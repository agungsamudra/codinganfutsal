<?php $this->load->view('template/header'); ?>

<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Data Pemesanan Lapangan</h3>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTables1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Pemesan</th>
                        <th>Lapangan</th>
                        <th>Tgl Booking</th>
                        <th>Total</th>
                        <th>Bukti Transfer</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pemesanan as $row) : ?>
                        <?php
                        if ($row['status'] == 'Belum Lunas') {
                            $status = 'bg-gray';
                        } elseif ($row['status'] == 'Lunas') {
                            $status = 'bg-success';
                        } elseif ($row['status'] == 'Batal') {
                            $status = 'bg-danger';
                        }
                        ?>
                        <tr class="<?= $status ?>">
                            <td></td>
                            <td><?php echo $row['kode_pemesanan'] . '<br>Tanggal: ' . date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                            <td><?php echo $row['nama_pemesan']; ?></td>
                            <td><?php echo $row['nama_lapangan']; ?></td>
                            <td><?php echo date('d-m-Y', strtotime($row['tgl_booking'])) . '<br>' . $row['jam_booking']; ?></td>
                            <td><?php echo number_format($row['total'], 0, ',', '.') . '<br>DP: ' . number_format($row['dp'], 0, ',', '.'); ?></td>
                            <td>
                                <?php if (!empty($row['file'])) : ?>
                                    <a href="<?php echo base_url($row['file']); ?>" class="btn btn-primary btn-xs" title="Lihat Bukti Transfer" target="_blank"><i class="fa fa-search"></i> Bukti Transfer</a>
                                <?php endif; ?>
                            </td>
                            <td><?php echo $row['status']; ?></td>
                            <td>
                                <a href="<?php echo base_url('pemesanan/ubah/' . $row['id_pemesanan']); ?>" class="btn btn-info btn-xs" title="Ubah Status"><span class="fa fa-edit"></span> Ubah Status</a>
                                <a href="#" data-href="<?php echo base_url('pemesanan/hapus/' . $row['id_pemesanan']); ?>" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-xs" title="Hapus"><span class="fa fa-trash"></span> Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $this->load->view('template/footer'); ?>