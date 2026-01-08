<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Halwaaz | My Orders</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .order-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            margin-bottom: 10px;
            border: 1px solid #eee;
            text-decoration: none;
            color: #000;
            background: #fff;
            border-radius: 6px;
        }

        .order-card:hover {
            background: #f9f9f9;
        }

        .delivery {
            color: #388e3c;
            font-size: 14px;
        }

        .arrow {
            font-size: 22px;
            color: #a01414ff;
        }
        .order-img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 6px;
    border: 1px solid #eee;
}
@media (max-width: 576px) {
    .order-img {
        width: 44px;
        height: 44px;
    }
}


    </style>
</head>

<body class="bg-light">


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
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> View Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="<?= base_url('logout') ?>"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-4">
    <h5 class="mb-3 fw-semibold">My Orders</h5>

    <?php if (!empty($orders)): ?>
        <?php foreach ($orders as $order): ?>
            <a href="<?= base_url('order_details/'.$order['order_id']) ?>"
               class="order-card shadow-sm">

                <!-- ITEM IMAGE -->
                <div class="d-flex align-items-center gap-3">
                    <img
                        src="<?= base_url('uploads/items/'.$order['item_image']) ?>"
                        onerror="this.src='<?= base_url('assets/no-image.png') ?>'"
                        class="order-img"
                        alt="<?= esc($order['item_name']) ?>">

                    <!-- ITEM INFO -->
                    <div>
                        <h6 class="mb-1 fw-semibold text-dark">
                            <?= esc($order['item_name']) ?>
                        </h6>

                        <p class="delivery mb-0">
                            Arriving on:
                            <strong><?= date('d M Y', strtotime($order['del_date'])) ?></strong>
                        </p>
                    </div>
                </div>

                <!-- ARROW -->
                <i class="bi bi-chevron-right arrow"></i>
            </a>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-info text-center">
            You have no orders yet.
        </div>
    <?php endif; ?>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
