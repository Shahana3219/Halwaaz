<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Userwise Sales Report</title>
</head>
<body>

<?php
$reportDate   = date('d M Y, h:i A');
$totalOrders = 0;
$totalItems  = 0;
$totalAmount = 0;
?>

<!-- ================= HEADER ================= -->
<table width="100%" cellpadding="4" cellspacing="0">
    <tr>
        <td width="70%">
            <h2 style="margin:0;">Halwaaz</h2>
            <span style="font-size:11px;">Userwise Sales Report</span>
        </td>
        <td width="30%" align="right" style="font-size:11px;">
            <b>Generated On:</b><br>
            <?= $reportDate ?>
        </td>
    </tr>
</table>

<hr>

<!-- ================= DATA TABLE ================= -->
<table width="100%" border="1" cellpadding="6" cellspacing="0">

    <!-- ===== TABLE HEADER ===== -->
    <thead>
        <tr style="background-color:#eeeeee; font-weight:bold;">
            <th width="5%"  align="center">No</th>
            <th width="25%" align="left">Name</th>
            <th width="15%" align="left">Phone</th>
            <th width="15%" align="center">Total Orders</th>
            <th width="15%" align="center">Total Items</th>
            <th width="25%" align="right">Revenue </th>
        </tr>
    </thead>

    <!-- ===== TABLE BODY ===== -->
    <tbody>

    <?php if (!empty($reports)): ?>
        <?php $no = 1; ?>
        <?php foreach ($reports as $row): ?>

        <tr>
            <td width="5%"  align="center"><?= $no++ ?></td>
            <td width="25%" align="left"><?= esc($row['user_name']) ?></td>
            <td width="15%" align="left"><?= esc($row['phone']) ?></td>
            <td width="15%" align="center"><?= $row['total_orders'] ?></td>
            <td width="15%" align="center"><?= $row['total_items'] ?></td>
            <td width="25%" align="right"><?= number_format($row['total_amount'], 2) ?></td>
        </tr>

        <?php
            $totalOrders += $row['total_orders'];
            $totalItems  += $row['total_items'];
            $totalAmount += $row['total_amount'];
        ?>
        <?php endforeach; ?>

        <!-- ===== TOTAL ROW ===== -->
        <tr style="font-weight:bold; background-color:#f2f2f2;">
            <td colspan="3" align="center">TOTAL</td>
            <td align="center"><?= $totalOrders ?></td>
            <td align="center"><?= $totalItems ?></td>
            <td align="right"><?= number_format($totalAmount, 2) ?></td>
        </tr>

    <?php else: ?>
        <tr>
            <td colspan="6" align="center">No data found</td>
        </tr>
    <?php endif; ?>

    </tbody>
</table>

</body>
</html>
