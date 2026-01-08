<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Halwaaz | Category Items</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
   <style>
/* Overlay */
.modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1050;
}

/* Modal box */
.modal-box {
    background: #fff;
    width: 420px;
    max-width: 90%;
    border-radius: 10px;
    padding: 20px 25px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    animation: scaleIn 0.25s ease-in-out;
}

/* Header */
.modal-header {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 15px;
    color: #333;
}

/* Body text */
#deliveryText {
    font-size: 15px;
    color: #555;
    margin-bottom: 25px;
}

/* Footer buttons */
.modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 15px; /* THIS fixes close buttons issue */
}

/* Cancel button */
.close-modal {
    background: #e9ecef;
    border: none;
    padding: 8px 18px;
    border-radius: 6px;
    cursor: pointer;
}

/* Confirm button */
.confirm-btn {
    background: #198754;
    color: #fff;
    border: none;
    padding: 8px 18px;
    border-radius: 6px;
    cursor: pointer;
}

.confirm-btn:hover {
    background: #157347;
}

.close-modal:hover {
    background: #dee2e6;
}

/* Animation */
@keyframes scaleIn {
    from {
        transform: scale(0.9);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}
</style>
</head>

<body class="bg-light">

<!-- ================= NAVBAR (SAME AS HOME) ================= -->
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
                <a class="nav-link" href="<?=base_url('home')?>"><i class="bi bi-receipt"></i> Dashboard</a>
            </li>
                <li class="nav-item">
    <a class="nav-link" href="<?= base_url('my_orders') ?>">
        <i class="bi bi-card-checklist"></i> My Orders
        <span id="ordersCount"><?= $ordersCount ?? 0 ?></span>
    </a>
</li>


                <li class="nav-item">
                    <a class="nav-link" href="<?=base_url('cart')?>"><i class="bi bi-cart"></i> My Cart
                    <span id="cartCount"><?=$cartCount ?? 0 ?></span>
                </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i> Account
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-person"></i> View Profile
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="<?= base_url('logout') ?>">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>

<!-- ================= PAGE CONTENT ================= -->
<div class="container py-5">

    <div class="row">

        <!-- ================= LEFT FILTER PANEL ================= -->
        <div class="col-md-3">
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h6 class="fw-semibold mb-3">
                <i class="bi bi-grid"></i> Categories
            </h6>

            <ul class="list-group list-group-flush">
<!--  loops through all categories and Creates one  (<a>) per category
        Highlights the  selected category -->
                <?php foreach ($categories as $cat): ?>
                    <a href="<?= base_url('items_by_category/' . $cat['id']) ?>"
                       class="list-group-item list-group-item-action
                       <?= ($cat['id'] == $selected_category_id) ? 'active' : '' ?>">
                        <?= esc($cat['name']) ?>
                    </a>
                <?php endforeach; ?>

            </ul>
        </div>
    </div>
</div>


        <!-- ================= ITEMS GRID ================= -->
        <div class="col-md-9">
          <h4 class="mb-4 text-center fw-semibold">
    <?= esc($selected_category_name) ?>
</h4>


            <div class="row g-4">

                <?php if (!empty($items)): ?>
                    <?php foreach ($items as $item): ?>

                        <!-- 2 ITEMS PER ROW -->
                        <div class="col-md-6">
                            <div class="card shadow-sm h-100">

                                <img src="<?= base_url('uploads/items/' . $item['image']) ?>"
                                     class="card-img-top"
                                     style="height:200px; object-fit:cover;">

                                <div class="card-body text-center">
                                    <h5 class="fw-semibold"><?=esc($item['name'])?></h5>

                                  <p class="text-muted mb-1">
    <?php if ($item['quantity'] > 0): ?>
        <span class="text-success fw-bold"><?= esc($item['quantity']) ?> left</span>
    <?php else: ?>
        <span class="text-danger fw-bold">Out of Stock</span>
    <?php endif; ?>
</p>


                                    <p class="fs-5 fw-bold text-success mb-3">
                                        Price :₹ <?=esc($item['amount'])?>
                                    </p>

                                   <div class="d-flex gap-2">
    <?php $inCart=in_array($item['id'],$cartItemIds??[]);?>
    <button class="btn btn-sm  flex-fill <?=$inCart? 'btn-success':'btn-outline-primary add_to_cart-btn'?>"
     data-id="<?=$item['id']?>"
                
     <?=$inCart ? 'disabled':''?>  
     >
        <i class="bi bi-cart-plus"></i>
        <?=$inCart ? 'Added to Cart':'Add to Cart'?>
    </button>

    <button 
    class="btn btn-success buy-btn"
    data-itemid="<?= $item['id'] ?>"
    <?= ($item['quantity'] <= 0) ? 'disabled' : '' ?>
>
    Buy
</button>



</div>

                                </div>

                            </div>
                        </div>

                    <?php endforeach; ?>
                <?php else: ?>

                    <div class="col-12 text-center text-muted">
                        No items available in this category
                    </div>

                <?php endif; ?>

            </div>
        </div>

    </div>
</div>

<!-- BUY CONFIRM MODAL -->
<div class="modal-overlay" id="buyModal" style="display:none;">
    <div class="modal-box">
        <div class="modal-header">Confirm Order</div>

        <p id="deliveryText"></p>

        <div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary close-modal">
        Cancel
    </button>

    <button type="button" class="btn btn-success" id="confirmBuy-btn">
        Confirm Order
    </button>
</div>

    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    $(document).on('click','.add_to_cart-btn',function(){
            let id=$(this).data('id');
            let btn=$(this);


        $.ajax(
            {
                url:"<?=base_url('add_to_cart')?>",
                type:"POST",
                data:{
                    id:id
                },
                dataType:"json",
                success: function(row){
                     console.log(row);
                    if(row.status=='success'){
                        btn.text('Added to cart')
                        .removeClass('btn-outline-primary')
                        .addClass('btn-success')
                        btn.prop('disabled',true);

                        //update cart count
                        $('#cartCount').text(row.count);
                    }
                }
            }
        )
        })
    </script>
    <script>
/* ================= BUY CONFIRM MODAL ================= */

// OPEN MODAL
let buyItemId = null;
$(document).on('click', '.buy-btn', function () {
    buyItemId = $(this).data('itemid');
    let deliveryDate = new Date();
    deliveryDate.setDate(deliveryDate.getDate() + 3);

    let formattedDate = deliveryDate.toLocaleDateString('en-GB', {
        day: '2-digit',
        month: 'short',
        year: 'numeric'
    });

    $('#deliveryText').text(
        'Your item will be delivered by ' + formattedDate +
        '. Are you sure you want to confirm the order?'
    );

    $('#buyModal').fadeIn();
});

// CONFIRM ORDER
$(document).on('click', '#confirmBuy-btn', function () {
 if (!buyItemId) {
        alert('Invalid item selected');
        return;
    }

    $.ajax({
        url: "<?= base_url('buy_now') ?>",
        type: "POST",
        dataType: "json",
        data:
        {
            item_id:buyItemId
        },
        success: function (response) {

            if (response.status === 'success') {
                 $('#buyModal').fadeOut();
                alert(response.message);
            } else {
                alert(response.message);
            }
        },
        error: function () {
            alert('Something went wrong. Please try again.');
        }
    });
});

// CLOSE MODAL (Cancel)
$(document).on('click', '.close-modal', function () {
    $('#buyModal').fadeOut();
});
</script>

</body>
</html>
