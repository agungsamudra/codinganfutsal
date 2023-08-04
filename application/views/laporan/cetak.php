<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Pemesanan Lapangan</title>

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 14px;
        }

        th {
            height: 30px;
            text-align: center;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 3px;
        }

        thead {
            background: lightgray;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }
    </style>
</head>

<body>
    <h2 class="center">LAPORAN PENDAPATAN<br>PERIODE <?php echo date('d-m-Y', strtotime($tgl1)) . ' s/d ' . date('d-m-Y', strtotime($tgl2)); ?></h2>
    <table>
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
                    <td class="center"><?php echo ++$no; ?></td>
                    <td class="center"><?php echo $row['kode_pemesanan']; ?></td>
                    <td class="center"><?php echo date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                    <td><?php echo $row['nama_pemesan']; ?></td>
                    <td><?php echo $row['nama_lapangan']; ?></td>
                    <td class="right"><?php echo number_format($row['total'], 0, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="5" class="right"><strong>TOTAL</strong></td>
                <td class="right"><strong><?php echo number_format($total, 0, ',', '.'); ?></strong></td>
            </tr>
        </tbody>
    </table>
</body>

</html>