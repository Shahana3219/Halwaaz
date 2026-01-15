<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Halwaaz | Order Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background:#f1f3f6;
        }

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

        .order-info {
            flex:1;
        }

        .order-info h6 {
            font-weight:600;
            margin-bottom:6px;
        }

        .order-info small {
            color:#6c757d;
        }

        .order-right {
            text-align:right;
            min-width:120px;
        }

        .price {
            font-size:18px;
            font-weight:700;
            color:#198754;
        }

        .order-header,
        .summary-box {
            background:#fff;
            border-radius:8px;
            padding:16px;
            box-shadow:0 1px 4px rgba(0,0,0,.08);
        }

        @media(max-width:576px){
            .order-box {
                flex-direction:column;
                align-items:flex-start;
            }

            .order-right {
                text-align:left;
                width:100%;
            }
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
            <small>Delivery by <?= date('d M Y', strtotime($order['del_date'])) ?></small>
        </div>

        <span class="badge bg-primary">
            <?= ucfirst($order['order_status']) ?>
        </span>
    </div>

   <?php foreach($items as $item): ?>

<?php
    // Unit price
    $unitPrice = isset($item['amount'])
        ? $item['amount']
        : ($item['total_amount'] / $item['item_quantity']);

    $itemTotal = $unitPrice * $item['item_quantity'];
?>

<div class="order-box">
    <img src="<?= base_url('uploads/items/'.$item['item_image']) ?>">

    <div class="order-info">
        <h6><?= esc($item['item_name']) ?></h6>
        <small>Quantity: <?= $item['item_quantity'] ?></small><br>
        <small>Price per item: ₹<?= number_format($unitPrice, 2) ?></small><br>
        <small>Expected delivery: <?= date('d M Y', strtotime($order['del_date'])) ?></small>
        <span class="badge bg-primary">
            <?= ucfirst($order['order_status']) ?>
        </span>
    

    </div>

    <div class="order-right">
        <div class="price">
            ₹<?= number_format($itemTotal, 2) ?>
        </div>
    </div>
</div>

<?php endforeach; ?>


<div class="summary-box mt-4 p-3 bg-white rounded shadow-sm">

<?php
    $grandTotal     = 0;
    $serviceCharge  = 0;
    $platformFee    = 0;
    $deliveryCharge = 0;
?>

<?php foreach ($items as $item): ?>

<?php
    $unitPrice = isset($item['amount'])
        ? $item['amount']
        : ($item['total_amount'] / $item['item_quantity']);

    $itemTotal = $unitPrice * $item['item_quantity'];
    $grandTotal += $itemTotal;
?>


<?php endforeach; ?>

<hr>

<div class="d-flex justify-content-between mb-2">
    <span>Service Charge</span>
    <span>₹0.00</span>
</div>

<div class="d-flex justify-content-between mb-2">
    <span>Platform Fee</span>
    <span>₹0.00</span>
</div>

<div class="d-flex justify-content-between mb-2">
    <span>Delivery Charge</span>
    <span>₹0.00</span>
</div>
<div class="d-flex justify-content-between mb-2">
    <span>
        <?= $item['item_quantity'] ?> × ₹<?= number_format($unitPrice, 2) ?>
    </span>
    <span>
        ₹<?= number_format($itemTotal, 2) ?>
    </span>
</div>
<hr>

<div class="d-flex justify-content-between">
    <strong>Total Amount</strong>
    <strong class="text-success fs-5">
        ₹<?= number_format(
            $grandTotal + $serviceCharge + $platformFee + $deliveryCharge,
            2
        ) ?>
    </strong>
</div>

</div>
<form action="<?= base_url('cancel_order') ?>" method="post">
    <input type="hidden" name="id" value="<?= $order['id'] ?>">
    <button type="submit">Cancel Order</button>
</form>






</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
