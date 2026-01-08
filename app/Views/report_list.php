<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Halwaaz | Reports</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
* {
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    margin: 0;
    min-height: 100vh;
    display: flex;
    background:
        linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.55)),
        url("<?= base_url('public/images/halwa3.jpg')?>")
        center / cover no-repeat fixed;
}

/* Sidebar */
.sidebar {
    width: 260px;
    background: linear-gradient(180deg, #4b0082, #8a2be2);
    color: #fff;
    padding: 30px 20px;
}

.sidebar h2 {
    text-align: center;
    margin-bottom: 40px;
}

.menu a {
    display: block;
    padding: 14px 16px;
    margin-bottom: 14px;
    border-radius: 10px;
    color: #fff;
    text-decoration: none;
    transition: 0.25s;
}

.menu a:hover {
    background: #fff;
    color: #4b0082;
    transform: translateX(8px);
}

/* Main */
.main {
    flex: 1;
    padding: 30px;
}

.header {
    background: #fff;
    padding: 22px;
    border-radius: 16px;
    margin-bottom: 25px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.25);
}

.header h1 {
    margin: 0;
    color: #8d1c6d;
}

/* Card */
.card {
    background: #fff;
    padding: 30px;
    border-radius: 18px;
    box-shadow: 0 15px 30px rgba(0,0,0,0.3);
    margin-bottom: 25px;
}

.card h2 {
    text-align: center;
    color: #4b0082;
    margin-bottom: 25px;
}

/* Filter Form */
.filter-form {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
}

.filter-form input {
    padding: 12px;
    border-radius: 10px;
    border: 1px solid #ccc;
    flex: 1;
}

.btn {
    padding: 12px 22px;
    border-radius: 12px;
    border: none;
    cursor: pointer;
    background: linear-gradient(90deg,#4b0082,#8a2be2);
    color: #fff;
    font-size: 14px;
}

.btn-reset {
    background: #e53935;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

/* Table */
table {
    width: 100%;
    border-collapse: collapse;
}

th {
    background: #f3e8ff;
    padding: 12px;
    text-align: left;
}

td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
}

tbody tr:hover {
    background: #faf7ff;
}
</style>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2>Halwaaz Admin</h2>
    <div class="menu">
        <a href="<?=base_url('/admin_dashboard')?>">Dashboard</a>
        <a href="<?=base_url('/add_category')?>">Add Category</a>
        <a href="<?=base_url('/add_item')?>">Add Items</a>
        <a href="<?= base_url('/orders_list') ?>">Orders</a>
        <a href="<?=base_url('/items_list')?>">Items List</a>
        <a href="<?=base_url('/report_section')?>">Reports</a>
        <a href="<?=base_url('/logout')?>">Logout</a>
    </div>
</div>

<!-- Main -->
<div class="main">

    <div class="header">
        <h1>Sales Reports</h1>
    </div>

    <!-- Filter Card -->
    <div class="card">
        <h2>Filter Report</h2>

        <form method="get" action="<?= base_url('report_list') ?>" class="filter-form">
            <input type="text" name="item_name"
                   placeholder="Item name"
                   value="<?= esc($itemName ?? '') ?>">

            <input type="date" name="from_date"
                   value="<?= esc($fromDate ?? '') ?>">

            <input type="date" name="to_date"
                   value="<?= esc($toDate ?? '') ?>">

            <button type="submit" class="btn">Search</button>
            <a href="<?= base_url('report_list') ?>" class="btn btn-reset">Reset</a>
        </form>
    </div>

    <!-- Table Card -->
    <div class="card">
        <h2>Sold Items Summary</h2>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Item Name</th>
                    <th>Total Sold</th>
                    <th>Total Revenue</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($reports)): ?>
                <?php $no=1; foreach ($reports as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($row['item_name']) ?></td>
                    <td><?= $row['total_sold'] ?></td>
                    <td>₹<?= number_format($row['total_amount'],2) ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align:center;">No data found</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>
</body>
</html>
