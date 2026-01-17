<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Halwaaz | Order Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body { background:#f1f3f6; }

        .order-box {
            background:#fff;
            border-radius:8px;
            padding:18px;
            margin-bottom:15px;
            display:flex;
            gap:20px;
            align-items:center;
            box-shadow:0 1px 4px rgba(0,0,0,.08);
        }

        .order-box img {
            width:110px;
            height:110px;
            object-fit:cover;
            border-radius:6px;
            border:1px solid #eee;
        }

        .order-info { flex:1; }
        .order-info h6 { font-weight:600; margin-bottom:6px; }
        .order-info small { color:#6c757d; }

        .order-right { text-align:right; min-width:120px; }
        .price { font-size:18px; font-weight:700; color:#198754; }

        .order-header,
        .summary-box {
            background:#fff;
            border-radius:8px;
            padding:16px;
            box-shadow:0 1px 4px rgba(0,0,0,.08);
        }

        @media(max-width:576px){
            .order-box { flex-direction:column; align-items:flex-start; }
            .order-right { text-align:left; width:100%; }
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-semibold text-primary" href="<?= base_url('/') ?>">
            <i class="bi bi-shop"></i> Halwaaz
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto gap-lg-3 align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('home') ?>"><i class="bi bi-receipt"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('my_orders') ?>">
                        <i class="bi bi-card-checklist"></i> My Orders
                        <span id="ordersCount"><?= $ordersCount ?? 0 ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('cart') ?>"><i class="bi bi-cart"></i> My Cart
                        <span id="cartCount"><?= $cartCount ?? 0 ?></span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i> Account
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li><a class="dropdown-item text-danger" href="<?= base_url('logout') ?>"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container my-4">

    <!-- ORDER HEADER -->
    <div class="order-header mb-3 d-flex justify-content-between align-items-center">
        <div>
            <h6 class="mb-1">Order #<?= $order['id'] ?></h6>
            <small>Delivery by <?= date('d M Y', strtotime($order['del_date'] ?? '')) ?></small>
        </div>
        <span class="badge bg-primary">
            <?= ucfirst($order['order_status'] ?? 'Pending') ?>
        </span>
    </div>


<?php
$grandTotal = 0;
?>

<!-- ORDER ITEMS -->
<?php foreach ($items as $item): ?>
<div class="order-box">
    <img src="<?= base_url('uploads/items/'.$item['item_image']) ?>" onerror="this.src='<?= base_url('assets/no-image.png') ?>'">
    <div class="order-info">
        <h6><?= esc($item['item_name']) ?></h6>
        <small>Quantity: <?= $item['item_quantity'] ?></small><br>
        <small>Unit Price: ₹<?= number_format($item['unit_price'], 2) ?></small><br>
        <small>Line Total: ₹<?= number_format($item['item_total'], 2) ?></small><br>
        <small>Expected Delivery: <?= date('d M Y', strtotime($order['del_date'] ?? '')) ?></small><br>
        <span class="badge bg-primary"><?= ucfirst($order['order_status'] ?? 'Pending') ?></span>
    </div>
</div>
<?php
$grandTotal += $item['item_total'];
?>
<?php endforeach; ?>

<!-- ORDER SUMMARY -->
<div class="summary-box mt-4 p-3">
    <h6>Order Summary</h6>
    <hr>
    <?php foreach ($items as $item): ?>
    <div class="d-flex justify-content-between">
        <span><?= $item['item_quantity'] ?> × <?= esc($item['item_name']) ?></span>
        <span>₹<?= number_format($item['item_total'], 2) ?></span>
    </div>
    <?php endforeach; ?>
    <hr>
    <div class="d-flex justify-content-between">
        <strong>Grand Total</strong>
        <strong class="text-success fs-5">₹<?= number_format($grandTotal, 2) ?></strong>
    </div>
</div>

<!-- CANCEL ORDER BUTTON -->
<form action="<?= base_url('cancel_order') ?>" method="post" class="mt-3">
    <input type="hidden" name="id" value="<?= $order['id'] ?>">
    <button type="submit" class="btn btn-danger">Cancel Order</button>
</form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
