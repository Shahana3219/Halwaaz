<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Halwaaz | Items</title>
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

/* Table */
.table-card {
    background: #fff;
    padding: 25px;
    border-radius: 18px;
    box-shadow: 0 15px 30px rgba(0,0,0,0.3);
}

.table-card h2 {
    color: #4b0082;
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
    text-align: left;
    vertical-align: middle;
}

th {
    background: #f3e8ff;
}

.item-img {
    width: 60px;
    height: 45px;
    object-fit: cover;
    border-radius: 6px;
}

.action {
    padding: 6px 12px;
    border-radius: 6px;
    color: #fff;
    font-size: 13px;
    text-decoration: none;
}
/* DELETE MODAL */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.6);
    display: none; /* ✅ VERY IMPORTANT */
    align-items: center;
    justify-content: center;
    z-index: 9999;
}

.modal-box {
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    width: 350px;
    text-align: center;
}

.modal-header {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 15px;
}

.modal-footer {
    margin-top: 20px;
    display: flex;
    justify-content: space-between;
}

.btn-close {
    background: #aaa;
    color: #fff;
    border: none;
    padding: 8px 14px;
    border-radius: 6px;
    cursor: pointer;
}

.dlt-btn {
    background: #e53935;
    color: #fff;
    border: none;
    padding: 8px 14px;
    border-radius: 6px;
    cursor: pointer;
}
/* FILTER BAR */
.filter-bar {
    background: #f8f3ff;
    padding: 16px;
    border-radius: 14px;
    margin-bottom: 20px;
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    align-items: center;
}

.filter-bar input,
.filter-bar select {
    padding: 10px 12px;
    border-radius: 10px;
    border: 1px solid #ccc;
    font-size: 14px;
}

.filter-bar input:focus,
.filter-bar select:focus {
    outline: none;
    border-color: #8a2be2;
}

.filter-bar .btn-filter {
    background: #8a2be2;
    color: #fff;
    border: none;
    padding: 10px 18px;
    border-radius: 10px;
    cursor: pointer;
    font-size: 14px;
}

.filter-bar .btn-filter:hover {
    background: #6a1bb2;
}
.btn-reset {
    background: #13c4a7ff; /* New color, e.g., coral */
    color: #691a1aff;
    padding: 10px 18px;
    border-radius: 10px;
    text-decoration: none;
    display: inline-block;
    transition: 0.25s;
}

.btn-reset:hover {
    background: #80a425ff; /* Slightly darker on hover */
}

.edit { background: #4caf50; }
.delete { background: #e53935; }
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
        <a href="<?= base_url('/items_list') ?>">Items List</a>
 <a href="<?= base_url('/report_section') ?>">Reports</a>
        <a href="<?= base_url('/logout') ?>">Logout</a>
    </div>
</div>

<!-- Main -->
<div class="main">

    <div class="header">
        <h1>Items Management</h1>
    </div>

    <!-- Items List -->
    <div class="table-card">
        <h2>Items List</h2>
<!-- FILTER & SEARCH BAR -->
 <form action="<?=base_url('items_list')?>" method="get">
<div class="filter-bar">

    <!-- Search by item name -->
    <input type="text" placeholder="Search item name…"
           name="search" value="<?=esc($_GET['search']??'')?>">

    <!-- Filter by category -->
    <select name="category">
                    <option value="">select a category</option>
                        <?php foreach ($categories as $cat): ?>
        <option value="<?= $cat['id'] ?>"
                <?=(($_GET['category_name']??'')==$cat['id'])? 'selected':''?>>
            <?= $cat['name'] ?>
        </option>
    <?php endforeach; ?>
</select>

    <!-- Sort by price -->
    <select  name="price_sort">
        <option value="">Sort by Price</option>
        <option value="price_asc"  <?= (($_GET['price_sort'] ?? '')=='price_asc')?'selected':'' ?>  >Low to High</option>
        <option value="price_desc" <?= (($_GET['price_sort'] ?? '')=='price_desc')?'selected':'' ?> >High to Low</option>
    </select>

    <!-- Sort by quantity -->
    <select  name="qty_sort">
        <option value="">Sort by Quantity</option>
        <option value="qty_asc"  <?= (($_GET['qty_sort'] ?? '')=='qty_asc')?'selected':'' ?> >Low to High</option>
        <option value="qty_desc" <?= (($_GET['qty_sort'] ?? '')=='qty_desc')?'selected':'' ?> >High to Low</option>
    </select>
               <!-- APPPLY BUTTON                  -->
    <button class="btn-filter" type="submit" >Apply</button>

    <!-- //RESET  -->

 <a href="<?= base_url('items_list') ?>"
          class="btn-reset"
          style="text-decoration:none;">
    Reset
    </a>

</div>
 </form>



        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Item Name</th>
                    <th>Category</th>
                    <th>Amount</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php if(!empty($items)):?>
                    <?php $No=1;?>
                        <?php foreach ($items as $item):?>

                <tr>
                    <td><?=$No++ ?></td>
                    <td><?=!empty($item['name'])? $item['name']:'No itemname'?></td>
                    <td><?= !empty($item['category']) ? $item['category'] : 'Unknown' ?></td>
                    <td class="text-end"><strong> <?= number_format($item['amount'], 2) ?></strong></td>
                    <td><?=!empty($item['quantity'])? $item['quantity']:'Unknown'?></td>
                   <td>
<?php if (!empty($item['image'])): ?>
    <a href="<?= base_url('uploads/items/' . $item['image']) ?>" target="_blank">
        View Image
    </a>
<?php else: ?>
    No Image
<?php endif; ?>
</td>
     <td>
            <a href="<?= base_url('edit_itemlist/'.$item['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
            <button class="btn-delete-item" data-id="<?=$item['id']?>">Delete</button>

    </td>

</tr>
<?php endforeach;?>
<?php else:?>
<tr>
    <td colspan="7"  style="text-align:center;">No items</td>
                        </tr>
                    <?php endif;?>
            </tbody>
        </table>

    </div>

</div>
 <!-- DELETE MODAL -->
<div class="modal-overlay" id="deleteModal">
    <div class="modal-box">
       <div class="modal-header">Delete Item</div>
<p>Are you sure you want to delete this item?</p>

        <input type="hidden" id="delete_id">

        <div class="modal-footer">
           <button type="button" class="btn-close close-modal">Cancel</button>
           <button type="button" class="dlt-btn" id="confirmDelete-btn">Delete</button>

        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready (function()
    {
      // OPEN MODAL
    $('.btn-delete-item').on('click', function () {
        let id = $(this).data('id');
        $('#delete_id').val(id);
        $('#deleteModal').fadeIn();
    });

        //delete modal
        $('#confirmDelete-btn').on('click',function(){
            let id=$('#delete_id').val();

             $.ajax({
                url:"<?=base_url('delete_item')?>",
                type:"POST",
                data:{id:id},  
                success: function(){
                    location.reload();
                }

            });
        });

                //CLOSE MODAL
        $('.close-modal').on('click',function(){
            $('.modal-overlay').fadeOut();
        });
        });
    </script>
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
