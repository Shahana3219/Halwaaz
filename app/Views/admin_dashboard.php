<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Halwaaz | Admin Dashboard</title>
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
        overflow: hidden;
    }

    /* ---------- Animations ---------- */
    @keyframes slideInLeft {
        from { transform: translateX(-100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }

    @keyframes fadeUp {
        from { transform: translateY(30px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    /* ---------- Sidebar ---------- */
    nav.sidebar {
        width: 260px;
        background: linear-gradient(180deg, #4b0082, #8a2be2);
        color: #fff;
        padding: 30px 20px;
        animation: slideInLeft 0.8s ease-out forwards;
    }

    .sidebar h2 {
        text-align: center;
        margin-bottom: 40px;
        font-size: 22px;
        animation: fadeUp 0.8s ease forwards;
    }

    .menu a {
        display: block;
        padding: 14px 16px;
        margin-bottom: 14px;
        border-radius: 10px;
        color: #ffffff;
        text-decoration: none;
        font-size: 15px;
        font-weight: 500;
        opacity: 0;
        animation: fadeUp 0.6s ease forwards;
        transition: background-color 0.25s ease,
                    color 0.25s ease,
                    transform 0.25s ease;
    }

    /* stagger effect */
    .menu a:nth-child(1) { animation-delay: 0.2s; }
    .menu a:nth-child(2) { animation-delay: 0.35s; }
    .menu a:nth-child(3) { animation-delay: 0.5s; }
    .menu a:nth-child(4) { animation-delay: 0.65s; }

    /* ✅ CLEAN HOVER — NO BLUR */
    .menu a:hover {
        background-color: #ffffff;
        color: #4b0082;
        transform: translateX(8px);
    }

    /* ---------- Main ---------- */
    main.main {
        flex: 1;
        padding: 30px;
        animation: fadeUp 0.8s ease forwards;
        animation-delay: 0.6s;
        opacity: 0;
    }

    header.page-header {
        background: rgba(255,255,255,0.95);
        padding: 22px 26px;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.25);
        margin-bottom: 30px;
        animation: fadeUp 0.8s ease forwards;
    }

    header.page-header h1 {
        margin: 0;
        color: #8d1c6d;
        font-size: 26px;
    }

    /* ---------- Responsive ---------- */
    @media (max-width: 768px) {
        body {
            flex-direction: column;
        }

        nav.sidebar {
            width: 100%;
            display: flex;
            justify-content: space-around;
        }

        .menu a {
            margin-bottom: 0;
            font-size: 14px;
        }
    }
</style>

</head>
<body>

<nav class="sidebar" aria-label="Admin navigation">
    <h2>Halwaaz Admin</h2>
    <div class="menu">
        <a href="<?=base_url('/admin_dashboard')?>">Dashboard</a>
        <a href="<?=base_url('/add_category')?>">Add Category</a>
        <a href="<?=base_url('/add_item')?>">Add Items</a>
        <a href="<?= base_url('/orders_list') ?>">Orders</a>
        <a href="<?= base_url('/items_list') ?>">Items</a>
         <a href="<?= base_url('/report_section') ?>">Reports</a>
        <a href="<?= base_url('/logout') ?>">Logout</a>
        
    </div>
</nav>

<main class="main">
    <header class="page-header">
        <h1>Welcome, Admin</h1>
    </header>
</main>

</body>
</html>
