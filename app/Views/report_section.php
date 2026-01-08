<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Halwaaz | Reports</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
*{
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    margin:0;
    min-height:100vh;
    display:flex;
    background:
        linear-gradient(rgba(0,0,0,0.55),rgba(0,0,0,0.55)),
        url("<?= base_url('public/images/halwa3.jpg')?>")
        center/cover no-repeat fixed;
}

/* Sidebar */
.sidebar{
    width:260px;
    background:linear-gradient(180deg,#4b0082,#8a2be2);
    color:#fff;
    padding:30px 20px;
}

.sidebar h2{
    text-align:center;
    margin-bottom:40px;
}

.menu a{
    display:block;
    padding:14px 16px;
    margin-bottom:14px;
    border-radius:10px;
    color:#fff;
    text-decoration:none;
    transition:.25s;
}

.menu a:hover{
    background:#fff;
    color:#4b0082;
    transform:translateX(8px);
}

/* Main */
.main{
    flex:1;
    padding:30px;
}

/* Header */
.header{
    background:#fff;
    padding:22px;
    border-radius:16px;
    margin-bottom:30px;
    box-shadow:0 10px 25px rgba(0,0,0,.25);
}

.header h1{
    margin:0;
    color:#8d1c6d;
}

/* Report cards */
.report-card{
    background:#fff;
    border-radius:18px;
    padding:50px 30px;
    text-align:center;
    box-shadow:0 15px 30px rgba(0,0,0,.3);
    transition:.3s;
    cursor:pointer;
    height:100%;
}

.report-card:hover{
    transform:translateY(-10px);
}

.report-icon{
    font-size:64px;
    margin-bottom:22px;
}

.item-icon{ color:#4b0082; }
.user-icon{ color:#198754; }

.report-card h4{
    font-weight:600;
    margin-bottom:10px;
}

.report-card p{
    color:#6c757d;
    margin:0;
}

a.report-link{
    text-decoration:none;
    color:inherit;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>Halwaaz Admin</h2>
    <div class="menu">
        <a href="<?=base_url('/admin_dashboard')?>">Dashboard</a>
        <a href="<?=base_url('/add_category')?>">Add Category</a>
        <a href="<?=base_url('/add_item')?>">Add Items</a>
        <a href="<?=base_url('/orders_list')?>">Orders</a>
        <a href="<?=base_url('/items_list')?>">Items List</a>
        <a href="<?=base_url('/report_section')?>">Reports</a>
        <a href="<?=base_url('/logout')?>">Logout</a>
    </div>
</div>

<!-- MAIN -->
<div class="main">

    <!-- HEADER -->
    <div class="header">
        <h1>Sales Reports</h1>
    </div>

    <!-- REPORT SELECTION -->
    <div class="row g-4 justify-content-center">

        <div class="col-md-5">
            <a href="<?= base_url('itemwise_report') ?>" class="report-link">
                <div class="report-card">
                    <div class="report-icon item-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <h4>Item-wise Reports</h4>
                    <p>Total sold quantity and revenue per item</p>
                </div>
            </a>
        </div>

        <div class="col-md-5">
            <a href="<?= base_url('userwise_report') ?>" class="report-link">
                <div class="report-card">
                    <div class="report-icon user-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h4>User-wise Reports</h4>
                    <p>Total orders and revenue per user</p>
                </div>
            </a>
        </div>

    </div>

</div>

</body>
</html>
