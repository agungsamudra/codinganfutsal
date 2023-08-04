<?php $this->load->view('template/header'); ?>

<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Data Lapangan</h3>
        <div class="box-tools">
            <a href="<?php echo base_url('lapangan/tambah'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
        </div>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="dataTables1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lapangan</th>
                        <th>Harga Sewa</th>
                        <th>Jadwal</th>
                        <th width="200">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lapangan as $row) : ?>
                        <tr>
                            <td></td>
                            <td><?php echo $row['nama_lapangan']; ?></td>
                            <td><?php echo number_format($row['harga_sewa'], 0, ',', '.') . '/jam'; ?></td>
                            <td>
                                <a href="<?php echo base_url('jadwal/' . $row['id_lapangan']); ?>" class="btn btn-info btn-xs" title="Jadwal Lapangan"><span class="fa fa-clock-o"></span> Jadwal</a>
                            </td>
                            <td>
                                <a href="<?php echo base_url('lapangan/detail/' . $row['id_lapangan']); ?>" class="btn btn-default btn-xs" title="Detail"><span class="fa fa-search"></span> Detail</a>
                                <a href="<?php echo base_url('lapangan/ubah/' . $row['id_lapangan']); ?>" class="btn btn-success btn-xs" title="Ubah"><span class="fa fa-pencil"></span> Ubah</a>
                                <a href="#" data-href="<?php echo base_url('lapangan/hapus/' . $row['id_lapangan']); ?>" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-xs" title="Hapus"><span class="fa fa-trash"></span> Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $this->load->view('template/footer'); ?>