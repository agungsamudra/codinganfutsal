<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Laporan Pendapatan Periode <?php echo date('d-m-Y', strtotime($tgl1)) . ' s/d ' . date('d-m-Y', strtotime($tgl2)); ?></h3>
        <div class="box-tools">
            <button id="btnExport" onclick="exportReportToExcel(this)" class="btn btn-success btn-sm"><i class="fa fa-file"></i> Export Excel</button>
            <a href="<?php echo site_url('laporan/pdf/' . $tgl1 . '/' . $tgl2); ?>" target="blank" class='btn btn-default btn-sm'><img src="<?php echo base_url('assets/images/pdf.png'); ?>"> Cetak PDF</a>
        </div>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Tanggal</th>
                        <th>Pemesan</th>
                        <th>Lapangan</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    $total = 0;
                    foreach ($pemesanan as $row) :
                        $total += $row['total']; ?>
                        <tr>
                            <td><?php echo ++$no; ?></td>
                            <td class="center"><?php echo $row['kode_pemesanan']; ?></td>
                            <td class="center"><?php echo date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                            <td><?php echo $row['nama_pemesan']; ?></td>
                            <td><?php echo $row['nama_lapangan']; ?></td>
                            <td class="right"><?php echo number_format($row['total'], 0, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="5" class="text-right"><strong>TOTAL</strong></td>
                        <td><strong><?php echo number_format($total, 0, ',', '.'); ?></strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function exportReportToExcel() {
        let table = document.getElementsByTagName("table");
        TableToExcel.convert(table[0], {
            name: 'laporan-pendapatan.xlsx',
            sheet: {
                name: 'Sheet 1'
            }
        });
    }
</script>