<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Halwaaz | Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
        overflow-x: hidden;
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

    @keyframes scaleIn {
        from { transform: scale(0.95); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }

    /* ---------- Sidebar ---------- */
    nav.sidebar {
        width: 260px;
        background: linear-gradient(180deg, #4b0082, #8a2be2);
        color: #fff;
        padding: 30px 20px;
        animation: slideInLeft 0.8s ease-out forwards;
        min-height: 100vh;
        overflow-y: auto;
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
    .menu a:nth-child(5) { animation-delay: 0.8s; }
    .menu a:nth-child(6) { animation-delay: 0.95s; }
    .menu a:nth-child(7) { animation-delay: 1.1s; }

    /* CLEAN HOVER — NO BLUR */
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
        overflow-y: auto;
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

    /* ---------- KPI Cards ---------- */
    .kpi-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .kpi-card {
        background: rgba(255,255,255,0.95);
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        animation: scaleIn 0.6s ease forwards;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .kpi-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.25);
    }

    .kpi-label {
        color: #666;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .kpi-value {
        font-size: 32px;
        font-weight: 600;
        color: #8d1c6d;
        margin-bottom: 8px;
    }

    .kpi-subtext {
        font-size: 12px;
        color: #999;
    }

    .kpi-icon {
        display: inline-block;
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #8a2be2, #4b0082);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        margin-bottom: 15px;
    }

    /* ---------- Charts Container ---------- */
    .charts-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }

    .chart-box {
        background: rgba(255,255,255,0.95);
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        animation: scaleIn 0.6s ease forwards;
    }

    .chart-box h3 {
        margin-top: 0;
        color: #8d1c6d;
        font-size: 18px;
        margin-bottom: 20px;
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 10px;
    }

    .chart-wrapper {
        position: relative;
        height: 300px;
    }

    /* ---------- Responsive ---------- */
    @media (max-width: 1024px) {
        .charts-container {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        body {
            flex-direction: column;
        }

        nav.sidebar {
            width: 100%;
            min-height: auto;
            display: flex;
            justify-content: space-around;
            padding: 15px 10px;
        }

        .sidebar h2 {
            font-size: 18px;
            margin-bottom: 10px;
            display: none;
        }

        .menu {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }

        .menu a {
            margin-bottom: 0;
            font-size: 12px;
            padding: 10px 12px;
        }

        main.main {
            padding: 20px;
        }

        .kpi-container {
            grid-template-columns: repeat(2, 1fr);
        }

        .charts-container {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .kpi-container {
            grid-template-columns: 1fr;
        }

        .status-grid {
            grid-template-columns: 1fr;
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
        <h1>📊 Dashboard Analytics</h1>
    </header>

    <!-- KPI Cards -->
    <section class="kpi-container">
        <div class="kpi-card">
            <div class="kpi-icon">📦</div>
            <div class="kpi-label">Total Items</div>
            <div class="kpi-value"><?= $totalItems ?></div>
            <div class="kpi-subtext">Active items in system</div>
        </div>


        <div class="kpi-card">
            <div class="kpi-icon">🏷️</div>
            <div class="kpi-label">Total Categories</div>
            <div class="kpi-value"><?= $totalCategories ?></div>
            <div class="kpi-subtext">Item categories</div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon">💰</div>
            <div class="kpi-label">Total Sales</div>
            <div class="kpi-value"><?= number_format($totalSales, 0) ?></div>
            
        </div>

       
    </section>

    <!-- Charts Section -->
    <section class="charts-container">
        <!-- Sales by Item Chart -->
        <div class="chart-box">
            <h3>📊 Sales by Item </h3>
            <div class="chart-wrapper">
                <canvas id="salesPieChart"></canvas>
            </div>
        </div>

     
       

     
    </section>


</main>

<script>
    // Data from PHP
    const salesByItem = <?= json_encode($salesByItem) ?>;
    const totalSales = <?= $totalSales ?>;
 

    // Chart colors
    const colors = [
        '#FF6B6B', '#4ECDC4', '#45B7D1', '#FFA07A', '#98D8C8',
        '#F7DC6F', '#BB8FCE', '#85C1E2', '#F8B88B', '#A3E4D7'
    ];

    // 1. Sales by Item - Pie Chart
    const salesCtx = document.getElementById('salesPieChart').getContext('2d');
   new Chart(salesCtx, {
    type: 'doughnut',
    data: {
        labels: salesByItem.map(item => item.name),
        datasets: [{
            data: salesByItem.map(item => item.sold),
            backgroundColor: colors.slice(0, salesByItem.length),
            borderColor: '#fff',
            borderWidth: 2,
            hoverOffset: 12
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,

        // 🔥 KEY FIXES
        cutout: '60%',        // thinner ring, more presence
        radius: '90%',        // fill container

        plugins: {
            legend: {
                position: 'right',   // ⬅️ BIG improvement
                labels: {
                    boxWidth: 14,
                    padding: 12,
                    font: {
                        size: 12,
                        family: "'Poppins', sans-serif"
                    }
                }
            },
            tooltip: {
                padding: 12,
                bodyFont: {
                    size: 13
                }
            }
        }
    }
});

   </script>

</body>
</html>
