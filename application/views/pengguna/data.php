<?php $this->load->view('template/header'); ?>

<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Data Pengguna</h3>
        <div class="box-tools">
            <a href="<?php echo base_url('pengguna/tambah'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
        </div>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="dataTables1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pengguna as $row) : ?>
                        <tr>
                            <td></td>
                            <td><?php echo $row['nama_lengkap']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['level']; ?></td>
                            <td>
                                <a href="<?php echo base_url('pengguna/ubah/' . $row['id_pengguna']); ?>" class="btn btn-success btn-xs" title="Ubah"><span class="fa fa-pencil"></span> Ubah</a>
                                <?php if ($this->session->userdata('username') != $row['username']) : ?>
                                    <a href="#" data-href="<?php echo base_url('pengguna/hapus/' . $row['id_pengguna']); ?>" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-xs" title="Hapus"><span class="fa fa-trash"></span> Hapus</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $this->load->view('template/footer'); ?>