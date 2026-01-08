<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Halwaaz | Orders List</title>
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

/* Orders Table */
.table-card {
    background: #fff;
    border-radius: 18px;
    padding: 25px;
    box-shadow: 0 15px 30px rgba(0,0,0,0.3);
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 14px;
    text-align: left;
    border-bottom: 1px solid #eee;
    font-size: 14px;
}

th {
    background: #f3f0ff;
    color: #4b0082;
}

.badge {
    padding: 6px 10px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 500;
}

.badge-placed { background:#dbeafe; color:#1e40af; }
.badge-cancelled { background:#fee2e2; color:#991b1b; }
.badge-delivered { background:#dcfce7; color:#166534; }

.action-btn {
    padding: 6px 10px;
    border-radius: 8px;
    font-size: 13px;
    border: none;
    cursor: pointer;
}

.view-btn {
    background:#4b0082;
    color:#fff;
}

.cancel-btn {
    background:#dc2626;
    color:#fff;
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
        <a href="<?=base_url('/orders_list')?>">Orders</a>
        <a href="<?=base_url('/items_list')?>">Items List</a>
         <a href="<?= base_url('/report_section') ?>">Reports</a>
        <a href="<?=base_url('/logout')?>">Logout</a>
    </div>
</div>

<!-- Main -->
<div class="main">

    <div class="header">
        <h1>Orders List</h1>
    </div>

    <div class="table-card">

       <table class="table table-bordered table-striped">
    <thead class="table-dark">
    <form method="get" action="<?= base_url('orders_list') ?>" style="margin-bottom:15px; display:flex; gap:10px; align-items:center;">

    <!-- Item Name Search -->
    <input type="text"
           name="item_name"
           placeholder="Item name"
           value="<?= esc($_GET['item_name'] ?? '') ?>"
           style="padding:8px;width:220px;border-radius:8px;border:1px solid #ccc;">

    <!-- Delivery Date Search -->
    <input type="date"
           name="del_date"
           value="<?= esc($_GET['del_date'] ?? '') ?>"
           style="padding:8px;border-radius:8px;border:1px solid #ccc;">delivery date

    <button type="submit" class="action-btn view-btn">
        Search
    </button>
     <!-- CLEAR BUTTON -->
    <a href="<?= base_url('orders_list') ?>"
       class="action-btn cancel-btn"
       style="text-decoration:none;">
        Clear
    </a>
</form>


        <tr>
            <th>Order ID</th>
            <th>User</th>
            <th>Phone</th>
            <th>Item</th>
            <th>Address</th>
            <th>Qty</th>
            <th>Amount</th>
            <th>Delivery Date</th>
            <th>Delivery Status</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
    <?php foreach ($orders as $order): ?>
        <tr>
            <td>#<?= $order['order_id'] ?></td>
            <td><?= esc($order['user_name']) ?><br><?= esc($order['address']) ?></td>
            <td><?= esc($order['phone']) ?></td>
            <td><?= esc($order['item_name']) ?></td>
            <td><?= esc($order['address']) ?></td>
            <td><?= $order['item_quantity'] ?></td>
            <td>₹<?= number_format($order['total_amount'] * $order['item_quantity'], 2) ?></td>
            <td><?= date('d M Y', strtotime($order['del_date'])) ?></td>
            <td>
                <span class="badge bg-info">
                    <?= esc($order['delivery_status']) ?>
                </span>
            </td>
            <td>
                <a href="<?= base_url('order_view/'.$order['order_id']) ?>"
                   class="btn btn-sm btn-primary">
                    View
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

    </div>

</div>

<script>
function cancelOrder(orderId)
{
    if (!confirm('Cancel this order?')) return;

    fetch("<?= base_url('admin-cancel-order') ?>", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        },
        body: JSON.stringify({ order_id: orderId })
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
        location.reload();
    });
}
</script>

</body>
</html>
