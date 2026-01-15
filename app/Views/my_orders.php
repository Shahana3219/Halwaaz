<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Halwaaz | My Orders</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            background: linear-gradient(90deg, #ffffff 0%, #f8f9fa 100%) !important;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08) !important;
        }

        .navbar-brand {
            font-size: 24px !important;
            background: linear-gradient(135deg, #ff6b6b, #ff8c42);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 700;
        }

        .nav-link {
            color: #555 !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: #ff8c42 !important;
        }

        .container {
            margin-top: 30px;
        }

        .page-title {
            color: #333;
            font-weight: 700;
            margin-bottom: 28px;
            font-size: 28px;
        }

        .order-card {
            display: flex;
            align-items: center;
            padding: 18px;
            margin-bottom: 14px;
            border: none;
            text-decoration: none;
            color: #333;
            background: white;
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
            transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
        }

        .order-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(0,0,0,0.15);
            background: linear-gradient(135deg, #fff8f8, #fff5f0);
        }

        .order-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #f0f0f0;
            margin-right: 18px;
            transition: all 0.3s ease;
        }

        .order-card:hover .order-img {
            transform: scale(1.05);
        }

        .order-details {
            flex: 1;
        }

        .order-name {
            font-weight: 700;
            font-size: 16px;
            color: #333;
            margin-bottom: 6px;
        }

        .order-price {
            color: #ff8c42;
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 6px;
        }

        .delivery {
            color: #34d399;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #e8f5e9;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .delivery::before {
            content: "\f2f5";
            font-family: "bootstrap-icons";
        }

        .arrow {
            font-size: 24px;
            color: #ff8c42;
            margin-left: 12px;
            transition: all 0.3s ease;
        }

        .order-card:hover .arrow {
            transform: translateX(6px);
        }

        .empty-message {
            background: white;
            padding: 60px 40px;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        }

        .empty-message i {
            font-size: 48px;
            color: #ff8c42;
            margin-bottom: 16px;
        }

        .empty-message h3 {
            color: #333;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .empty-message p {
            color: #999;
            margin-bottom: 24px;
        }

        .empty-message .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            padding: 12px 32px;
            font-weight: 600;
        }

        @media (max-width: 576px) {
            .order-img {
                width: 70px;
                height: 70px;
                margin-right: 12px;
            }

            .order-name {
                font-size: 14px;
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
