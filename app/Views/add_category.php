<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Halwaaz | Category</title>
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

/* Form */
.form-card {
    max-width: 480px;
    background: #fff;
    padding: 30px;
    border-radius: 18px;
    box-shadow: 0 15px 30px rgba(0,0,0,0.3);
    margin-bottom: 35px;
}

.form-card h2 {
    text-align: center;
    color: #4b0082;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 18px;
}

.form-group label {
    display: block;
    margin-bottom: 6px;
}

.form-group input {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    border: 1px solid #ccc;
}

.btn {
    width: 100%;
    padding: 12px;
    background: linear-gradient(90deg,#4b0082,#8a2be2);
    color: #fff;
    border: none;
    border-radius: 12px;
    font-size: 15px;
    cursor: pointer;
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
}

th {
    background: #f3e8ff;
}

.action {
    padding: 6px 12px;
    border-radius: 6px;
    color: #fff;
    font-size: 13px;
    text-decoration: none;
}
/* Modal Overlay */
.modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.6);
    z-index: 999;
}

/* Modal Box */
.modal-box {
    background: #fff;
    width: 400px;
    margin: 120px auto;
    padding: 25px;
    border-radius: 12px;
}

.modal-header {
    font-size: 18px;
    margin-bottom: 15px;
    font-weight: 600;
}

.modal-footer {
    margin-top: 20px;
    text-align: right;
}

.modal-footer button {
    padding: 8px 14px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}
/* Flash Messages */
.alert {
    padding: 12px 18px;
    margin-bottom: 20px;
    border-radius: 12px;
    font-weight: 500;
    font-size: 14px;
}

.alert-success {
    background-color: #d4edda; /* light green */
    color: #155724; /* dark green text */
    border: 1px solid #c3e6cb;
}

.alert-danger {
    background-color: #f8d7da; /* light red */
    color: #721c24; /* dark red text */
    border: 1px solid #f5c6cb;
}

.btn-close { background: #ccc; }
.btn-save  { background: #4caf50; color: #fff; }
.btn-del   { background: #e53935; color: #fff; }

.edit { background: #4caf50; }
.delete { background: #e53935; }
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
        <a href="<?=base_url('/items_list')?>">Items List
         <a href="<?= base_url('/report_section') ?>">Reports</a>
        <a href="<?=base_url('/logout')?>">Logout</a>
    </div>
</div>

<!-- Main -->
<div class="main">

    <div class="header">
        <h1>Category Management</h1>
    </div>

    <!-- Add Category -->
    <div class="form-card">
        <h2>Add Category</h2>
        <?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

        <form action="<?=base_url('save_category')?>" method="post">
            <div class="form-group">
                <label>Category Name</label>
                <input type="text" name="name" placeholder="Enter category name">
            </div>

            
            <button type="submit"class="btn">Save Category</button>
        </form>
    </div>

    <!-- Category List -->
    <div class="table-card">
        <h2>Category List</h2>

<form action="<?=base_url('add_category')?>" method="get">
    <div class="filter-bar">

    <!-- Search by item name -->
    <input type="text" placeholder="Search item name…"
           name="search" value="<?=esc($_GET['search']??'')?>">
<button class="btn-filter" type="submit" >Apply</button>

    <!-- //RESET  -->

 <a href="<?= base_url('add_category') ?>"
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
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($categories)):?>
                    <?php $No=1;?>
                        <?php foreach ($categories as $category):?>
                <tr>
                     <td><?=$No++ ?></td>
                    <td><?=!empty($category['name'])? $category['name']:'No itemname'?></td>
                    <td> 
                    
                    
 <button type="button" class="edit-btn" 
            data-id="<?=$category['id']?>"
            data-name="<?=esc($category['name'])?>">Edit
</button>

<button type="button" class="dlt-btn"
 data-id="<?=$category['id']?>">Delete</button>
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
            <!-- EDIT MODAL -->
<div class="modal-overlay" id="editModal">
    <div class="modal-box">
        <div class="modal-header">Edit Category</div>

        <form id="editForm">
            <input type="hidden" name="id" id="edit_id">

            <label>Category Name</label>
            <input type="text" name="name" id="edit_name" required>

            <div class="modal-footer">
                <button type="button" class="btn-close close-modal" id="cancel-btn" >Cancel</button>
                <button type="submit" class="btn-save" id="update-btn">Update</button>
            </div>
        </form>
    </div>
</div>
                <!-- DELETE MODAL -->
<div class="modal-overlay" id="deleteModal">
    <div class="modal-box">
        <div class="modal-header">Delete Category</div>

        <p>Are you sure you want to delete this category?</p>

        <input type="hidden" id="delete_id">

        <div class="modal-footer">
            <button type="button" class="btn-close close-modal" id="cancel-btn">Cancel</button>
            <button type="button" class="btn-del" id="confirmDelete-btn">Delete</button>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready (function(){
        $('.edit-btn').on('click',function()
    {

        $('#edit_id').val($(this).data('id'));
        $('#edit_name').val($(this).data('name'));
        
        // Show modal with fade effect
        $('#editModal').fadeIn();
    });

           //SUBMIT EDIT FORM
           
           $('#editForm').on('submit',function(e)
        {
//stops the form’s default behavior, which is:
//Submitting the form and reloading the page
            e.preventDefault(); 

            $.ajax({
                url:"<?=base_url('save_edit_category')?>",
                type:"POST",
                data:{
                    id:$('#edit_id').val(),
                    name:$('#edit_name').val()
                },   //sends id + name
                success: function(){
                    location.reload();
                }

            });
        });
        //delete modal

   $('.dlt-btn').on('click', function () {
        let id = $(this).data('id');

        $('#delete_id').val(id);
        $('#deleteModal').fadeIn();
    });

        //delete modal
        $('#confirmDelete-btn').on('click',function(){
            let id=$('#delete_id').val();

             $.ajax({
                url:"<?=base_url('delete_category')?>",
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
</body>
</html>
