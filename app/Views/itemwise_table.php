<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Itemwise Sales Report</title>

    <style>
        body {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .report-table th,
        .report-table td {
            border: 1px solid #000;
            padding: 6px;
        }

        .report-table thead th {
            background-color: #eeeeee;
            font-weight: bold;
        }

        .center { text-align: center; }
        .right  { text-align: right; }

        .total-row {
            font-weight: bold;
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

<?php
$reportDate    = date('d M Y, h:i A');
$totalSold    = 0;
$totalRevenue = 0;
?>

<!-- ================= HEADER (NO BORDERS) ================= -->
<table border="0" cellpadding="4">
    <tr>
        <td width="70%">
            <h2 style="margin:0;">Halwaaz</h2>
            <span>Itemwise Sales Report</span>
        </td>
        <td width="30%" align="right">
            <b>Generated On:</b><br>
            <?= $reportDate ?>
        </td>
    </tr>
</table>

<br>

<!-- ================= REPORT TABLE ================= -->
<table class="report-table">

    <!-- 🔒 SINGLE SOURCE OF TRUTH FOR WIDTH -->
    <colgroup>
        <col width="8%">
        <col width="42%">
        <col width="20%">
        <col width="30%">
    </colgroup>

    <thead>
        <tr>
            <th class="center">No</th>
            <th>Item Name</th>
            <th class="center">Total Sold</th>
            <th class="right">Revenue</th>
        </tr>
    </thead>

    <tbody>
        <?php if (!empty($reports)): ?>
            <?php $no = 1; foreach ($reports as $row): ?>
                <tr>
                    <td class="center"><?= $no++ ?></td>
                    <td><?= esc($row['item_name']) ?></td>
                    <td class="center"><?= $row['total_sold'] ?></td>
                    <td class="right"><?= number_format($row['total_amount'], 2) ?></td>
                </tr>

                <?php
                    $totalSold    += $row['total_sold'];
                    $totalRevenue += $row['total_amount'];
                ?>
            <?php endforeach; ?>

            <tr class="total-row">
                <td colspan="2" class="center">TOTAL</td>
                <td class="center"><?= $totalSold ?></td>
                <td class="right"><?= number_format($totalRevenue, 2) ?></td>
            </tr>

        <?php else: ?>
            <tr>
                <td colspan="4" class="center">No data found</td>
            </tr>
        <?php endif; ?>
    </tbody>

</table>

</body>
</html>
