<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Halwaaz | Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
    * { box-sizing: border-box; font-family: 'Poppins', sans-serif; }
    body {
        margin: 0;
        min-height: 100vh;
        display: flex;
        background:
            linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.55)),
            url("<?= base_url('public/images/halwa3.jpg')?>") center / cover no-repeat fixed;
        overflow-x: hidden;
    }/* ---------- Charts Layout (THIS IS WHAT YOU ARE MISSING) ---------- */
.charts-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 25px;
    margin-top: 30px;
}

.chart-box {
    background: rgba(255,255,255,0.95);
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

.chart-box h3 {
    margin-top: 0;
    color: #8d1c6d;
    font-size: 18px;
    margin-bottom: 15px;
}

.chart-wrapper {
    position: relative;
    height: 350px;   /* CRITICAL FOR PIE CHART */
    width: 100%;
}


    nav.sidebar {
        width: 260px;
        background: linear-gradient(180deg, #4b0082, #8a2be2);
        color: #fff;
        padding: 30px 20px;
        min-height: 100vh;
        overflow-y: auto;
    }

    .sidebar h2 { text-align: center; margin-bottom: 40px; font-size: 22px; }
    .menu a {
        display: block;
        padding: 14px 16px;
        margin-bottom: 14px;
        border-radius: 10px;
        color: #fff;
        text-decoration: none;
        font-size: 15px;
        font-weight: 500;
        transition: background-color 0.25s ease, color 0.25s ease, transform 0.25s ease;
    }
    .menu a:hover { background-color: #fff; color: #4b0082; transform: translateX(8px); }

    main.main { flex: 1; padding: 30px; overflow-y: auto; }
    header.page-header { background: rgba(255,255,255,0.95); padding: 22px 26px; border-radius: 16px; margin-bottom: 30px; }
    header.page-header h1 { margin: 0; color: #8d1c6d; font-size: 26px; }

    .kpi-container { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px; }
    .kpi-card { background: rgba(255,255,255,0.95); padding: 25px; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.15); }
    .kpi-label { color: #666; font-size: 14px; font-weight: 500; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px; }
    .kpi-value { font-size: 32px; font-weight: 600; color: #8d1c6d; margin-bottom: 8px; }
    .kpi-subtext { font-size: 12px; color: #999; }
    .kpi-icon {
        display: flex; align-items: center; justify-content: center;
        width: 50px; height: 50px; border-radius: 10px;
        background: linear-gradient(135deg, #8a2be2, #4b0082);
        color: white; font-size: 24px; margin-bottom: 15px;
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
            <div class="kpi-icon">🛒</div>
            <div class="kpi-label">Total Sales</div>
            <div class="kpi-value"><?= number_format($totalSales, 0) ?></div>
            <div class="kpi-subtext">Total orders placed</div>
        </div>
    </section>
    <!-- KPI Cards remain the same -->

<!-- Charts Section -->
<section class="charts-container">
    <!-- Sales by Item Chart -->
    <div class="chart-box">
        <h3>📊 Sales by Item</h3>
        <div class="chart-wrapper">
            <canvas id="salesPieChart"></canvas>
        </div>
    </div>
</section>

                <!-- Library used for piechart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // PHP data: number of items sold per item
    const salesByItem = <?= json_encode($salesByItem) ?>;

    // Colors for chart
    const colors = [
        '#FF6B6B', '#4ECDC4', '#45B7D1', '#FFA07A', '#98D8C8',
        '#F7DC6F', '#BB8FCE', '#85C1E2', '#F8B88B', '#A3E4D7'
    ];

    //pie and doughnut are built-in chart types
    //No extension or plugin required


    // Pie Chart: Sales by Item
    const ctx = document.getElementById('salesPieChart').getContext('2d');
    new Chart(ctx, {
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
            cutout: '60%',
            radius: '90%',
            plugins: {
                legend: {
                    position: 'right',
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

</main>

</body>
</html>
