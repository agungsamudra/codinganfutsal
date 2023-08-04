<?php $this->load->view('template/header'); ?>

<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Jadwal <?= $lapangan['nama_lapangan'] ?></h3>
        <div class="box-tools">
            <a href="<?= base_url('lapangan'); ?>" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
            <a href="<?= base_url('jadwal/tambah/' . $lapangan['id_lapangan']); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
        </div>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="dataTables1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jam</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($jadwal as $row) : ?>
                        <tr>
                            <td></td>
                            <td><?= $row['jam']; ?></td>
                            <td>
                                <a href="<?= base_url('jadwal/ubah/' . $lapangan['id_lapangan'] . '/' . $row['id_jadwal']); ?>" class="btn btn-success btn-xs" title="Ubah"><span class="fa fa-pencil"></span> Ubah</a>
                                <a href="#" data-href="<?= base_url('jadwal/hapus/' . $lapangan['id_lapangan'] . '/' . $row['id_jadwal']); ?>" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-xs" title="Hapus"><span class="fa fa-trash"></span> Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $this->load->view('template/footer'); ?>