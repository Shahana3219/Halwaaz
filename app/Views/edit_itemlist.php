<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Halwaaz | Edit Item</title>
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

/* Form Card */
.form-card {
    max-width: 700px;
    background: #fff;
    padding: 30px;
    border-radius: 18px;
    box-shadow: 0 15px 30px rgba(0,0,0,0.3);
}

.form-card h2 {
    text-align: center;
    color: #4b0082;
    margin-bottom: 25px;
}

.form-group {
    margin-bottom: 18px;
}

.form-group label {
    display: block;
    margin-bottom: 6px;
    font-weight: 500;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    border: 1px solid #ccc;
}

.form-row {
    display: flex;
    gap: 15px;
}

.form-row .form-group {
    flex: 1;
}

.image-preview {
    margin-top: 8px;
}

.image-preview img {
    width: 120px;
    height: 90px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #ccc;
}

.btn {
    width: 100%;
    padding: 13px;
    background: linear-gradient(90deg,#4b0082,#8a2be2);
    color: #fff;
    border: none;
    border-radius: 12px;
    font-size: 16px;
    cursor: pointer;
    margin-top: 10px;
}

.btn:hover {
    opacity: 0.9;
}

.btn-danger {
    background: #e53935;
    margin-top: 12px;
}

/* Modal */
.modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.6);
    justify-content: center;
    align-items: center;
}

.modal-content {
    background: #fff;
    padding: 25px;
    border-radius: 14px;
    width: 380px;
    text-align: center;
}

.modal-content h3 {
    margin-top: 0;
    color: #e53935;
}

.modal-actions {
    display: flex;
    gap: 10px;
    margin-top: 20px;
}

.modal-actions button {
    flex: 1;
    padding: 10px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
}

.cancel {
    background: #ccc;
}

.confirm {
    background: #e53935;
    color: #fff;
}
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
        <a href="<?= base_url('/items_list') ?>">Items</a>
        <a href="<?= base_url('/logout') ?>">Logout</a>
    </div>
</div>

<!-- Main -->
<div class="main">

    <div class="header">
        <h1>Edit Item</h1>
    </div>

    <div class="form-card">
        <h2>Update Item Details</h2>
<?php if(session()->getFlashdata('update_success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('update_success') ?>
    </div>
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

        <form action="<?=base_url('save_edit_itemlist')?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Item Name</label>
                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                <input type="text" name="name" value="<?= $item['name'] ?? '' ?>">

            </div>

            <div class="form-group">
                <label>Category</label>
                <select name="category">
                    <option value="">select category</option>

                    <?php foreach($categories as $cat):?>
                        <option value="<?=$cat['id']?>"
                        <?=($cat['id']==$item['category'] )? 'selected':''?>>
                        <?=esc($cat['name'])?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Amount</label>
                    <input type="number" name="amount" value="<?= $item['amount'] ?? '' ?>">
                </div>

                <div class="form-group">
                    <label>Quantity</label>
                    <input type="text"name="quantity" value="<?= $item['quantity'] ?? '' ?>">
                </div>
            </div>

            <div class="form-group">
                <label>Change Image</label>
                <input type="hidden" name="old_image" value="<?= $item['image'] ?>">
                <input type="file" name="image">
                <div class="image-preview">
                    <?php if (!empty($item['image'])): ?>
                    <img src="<?= base_url('uploads/items' . $item['image']) ?>"
                     alt="<?= esc($item['name']) ?>">
                    <?php endif; ?>

                </div>
            </div>

            <button type="submit" class="btn">Update Item</button>
            
        </form>
    </div>

</div>

</body>
</html>
