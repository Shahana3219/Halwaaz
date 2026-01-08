<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Halwaaz | Add Items</title>
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
    max-width: 650px;
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
    transform: translateY(-2px);
}
/* Flash Messages */
.flash-success {
    padding: 12px 18px;
    margin-bottom: 20px;
    border-radius: 12px;
    font-weight: 500;
    font-size: 14px;
    background-color: #d4edda; /* light green */
    color: #155724; /* dark green text */
    border: 1px solid #c3e6cb;
}

.flash-error {
    padding: 12px 18px;
    margin-bottom: 20px;
    border-radius: 12px;
    font-weight: 500;
    font-size: 14px;
    background-color: #f8d7da; /* light red */
    color: #721c24; /* dark red text */
    border: 1px solid #f5c6cb;
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
      <a href="<?= base_url('/orders_list') ?>">Orders</a>
        <a href="<?=base_url('/items_list')?>">Items List</a>
         <a href="<?= base_url('/report_section') ?>">Reports</a>
        <a href="<?= base_url('/logout') ?>">Logout</a>
    </div>
</div>

<!-- Main -->
<div class="main">

    <div class="header">
        <h1>Add Items</h1>
    </div>

    <div class="form-card">
        <h2>New Item</h2>
<?php if (session()->getFlashdata('save_success')): ?>
    <div class="flash-success">
        <?= session()->getFlashdata('save_success') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('save_error')): ?>
    <div class="flash-error">
        Something went wrong. Please try again.
    </div>
<?php endif; ?>

        <form action="<?=base_url('save_item')?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Item Name</label>
                <input type="text" name="name" placeholder="Enter item name">
            </div>

            <div class="form-group">
                <label>Category Name</label>
                <select name="category">
                    <option value="">select a category</option>
                        <?php foreach ($categories as $cat): ?>
        <option value="<?= $cat['id'] ?>">
            <?= $cat['name'] ?>
        </option>
    <?php endforeach; ?>
</select>

            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Amount</label>
                    <input type="number" name="amount" placeholder="Enter price">
                </div>

                <div class="form-group">
                    <label>Quantity</label>
                    <input type="text" name="quantity" placeholder="e.g. 250g / 1kg">
                </div>
            </div>

            <div class="form-group">
                <label>Item Image</label>
                <input type="file" name="image">
            </div>

            <button type="submit" class="btn">Save Item</button>
        </form>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    $(document).ready (function()
    {
        $('#category-select').on('click',function(){

            $.ajax({
                url:"<?=base_url('get_categories')?>",
                type:"POST",
                dataType:"json",
                success: function(response){
                    $('#category-select').html('<option value="">Select category</option>');

                        if(!response.length){
                             $('#category-select').append('<option value="">No categories found</option>');

                             return;
                        }
//forEach loops through each element in the response array.
//row represents one object at a time.
                        response.forEach (function(row)
                    {
                          $('#category-select').append(
                            '<option value="' +row.id+ '">' +row.name+ '</option>');
                    
                
                });
            }
        });

    });

});
</script>
</body>
</html>
