<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Halwaaz | Items</title>
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
        url("images/halwa3.jpg")
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

/* Table */
.table-card {
    background: #fff;
    padding: 25px;
    border-radius: 18px;
    box-shadow: 0 15px 30px rgba(0,0,0,0.3);
}

.table-card h2 {
    color: #4b0082;
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
    text-align: left;
    vertical-align: middle;
}

th {
    background: #f3e8ff;
}

.item-img {
    width: 60px;
    height: 45px;
    object-fit: cover;
    border-radius: 6px;
}

.action {
    padding: 6px 12px;
    border-radius: 6px;
    color: #fff;
    font-size: 13px;
    text-decoration: none;
}
/* DELETE MODAL */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.6);
    display: none; /* ✅ VERY IMPORTANT */
    align-items: center;
    justify-content: center;
    z-index: 9999;
}

.modal-box {
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    width: 350px;
    text-align: center;
}

.modal-header {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 15px;
}

.modal-footer {
    margin-top: 20px;
    display: flex;
    justify-content: space-between;
}

.btn-close {
    background: #aaa;
    color: #fff;
    border: none;
    padding: 8px 14px;
    border-radius: 6px;
    cursor: pointer;
}

.dlt-btn {
    background: #e53935;
    color: #fff;
    border: none;
    padding: 8px 14px;
    border-radius: 6px;
    cursor: pointer;
}
/* FILTER BAR */
.filter-bar {
    background: #f8f3ff;
    padding: 16px;
    border-radius: 14px;
    margin-bottom: 20px;
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    align-items: center;
}

.filter-bar input,
.filter-bar select {
    padding: 10px 12px;
    border-radius: 10px;
    border: 1px solid #ccc;
    font-size: 14px;
}

.filter-bar input:focus,
.filter-bar select:focus {
    outline: none;
    border-color: #8a2be2;
}

.filter-bar .btn-filter {
    background: #8a2be2;
    color: #fff;
    border: none;
    padding: 10px 18px;
    border-radius: 10px;
    cursor: pointer;
    font-size: 14px;
}

.filter-bar .btn-filter:hover {
    background: #6a1bb2;
}
.btn-reset {
    background: #13c4a7ff; /* New color, e.g., coral */
    color: #691a1aff;
    padding: 10px 18px;
    border-radius: 10px;
    text-decoration: none;
    display: inline-block;
    transition: 0.25s;
}

.btn-reset:hover {
    background: #80a425ff; /* Slightly darker on hover */
}

.edit { background: #4caf50; }
.delete { background: #e53935; }
</style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2>Halwaaz Admin</h2>
    <div class="menu">
        <a href="<?= base_url('/admin_dashboard') ?>">Dashboard</a>
        <a href="<?= base_url('/add_category') ?>">Add Category</a>
        <a href="<?= base_url('/add_item') ?>">Add Items</a>
        <a href="<?= base_url('/orders_list') ?>">Orders</a>
        <a href="<?= base_url('/items_list') ?>">Items List</a>
        <a href="<?= base_url('/report_section') ?>">Reports</a>
        <a href="<?= base_url('/logout') ?>">Logout</a>
    </div>
</div>

<!-- Main Content -->
<div class="main">

    <!-- Header -->
    <div class="header">
        <h1>Orders Management</h1>
    </div>

    <!-- Table Card -->
    <div class="table-card">

        <h2>Orders List</h2>

        <!-- FILTER BAR -->
        <form method="get" class="filter-bar">
            <input type="text" name="item_name" placeholder="Item Name"
                   value="<?= esc($itemName ?? '') ?>">

            <input type="date" name="del_date"
                   value="<?= esc($delDate ?? '') ?>">

            <select name="order_status">
                <option value="">All Status</option>
                <option value="Placed" <?= ($selected_status ?? '') === 'Placed' ? 'selected' : '' ?>>
                    Placed
                </option>
                <option value="Cancelled" <?= ($selected_status ?? '') === 'Cancelled' ? 'selected' : '' ?>>
                    Cancelled
                </option>
            </select>

            <button type="submit" class="btn-filter">Filter</button>
            <a href="<?= base_url('orders_list') ?>" class="btn-reset">Reset</a>
        </form>

        <!-- TABLE -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Item</th>
                    <th>Order Date</th>
                    <th>Delivery Date</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($orders)): ?>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?= esc($order['id']) ?></td>
                            <td><?= esc($order['user_name']) ?></td>
                            <td><?= esc($order['item_name']) ?></td>
                            <td><?= esc($order['order_date']) ?></td>
                            <td><?= esc($order['del_date']) ?></td>
                            <td>₹<?= number_format($order['total_amount'], 2) ?></td>
                            <td><?= esc($order['order_status']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align:center;">No orders found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>
</div>

</body>

</body>
</html>
