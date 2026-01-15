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
            font-size: 32px;
            background: linear-gradient(135deg, #ff6b6b, #ff8c42);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .item-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
            height: 100%;
        }

        .item-card:hover {
            transform: translateY(-12px) scaleX(1.02);
            box-shadow: 0 16px 40px rgba(0,0,0,0.2);
        }

        .item-image {
            height: 240px;
            overflow: hidden;
            background: #f0f0f0;
            position: relative;
        }

        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .item-card:hover .item-image img {
            transform: scale(1.1);
        }

        .item-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: linear-gradient(135deg, #ff6b6b, #ff8c42);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .item-body {
            padding: 18px;
        }

        .item-name {
            font-size: 16px;
            font-weight: 700;
            color: #333;
            margin-bottom: 6px;
        }

        .item-price {
            font-size: 18px;
            color: #ff8c42;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .item-description {
            font-size: 12px;
            color: #999;
            margin-bottom: 14px;
            line-height: 1.4;
        }

        .item-footer {
            display: flex;
            gap: 8px;
            justify-content: space-between;
        }

        .btn-add-cart {
            flex: 1;
            background: linear-gradient(135deg, #34d399, #10b981);
            border: none;
            color: white;
            padding: 10px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 13px;
        }

        .btn-add-cart:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(52, 211, 153, 0.3);
        }

        .btn-buy {
            flex: 1;
            background: linear-gradient(135deg, #ff6b6b, #ff8c42);
            border: none;
            color: white;
            padding: 10px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 13px;
        }

        .btn-buy:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 107, 107, 0.3);
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

/* Modal Styling */
.modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.6);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1050;
    backdrop-filter: blur(4px);
}

/* Modal box */
.modal-box {
    background: white;
    width: 420px;
    max-width: 90%;
    border-radius: 18px;
    padding: 28px;
    box-shadow: 0 25px 65px rgba(0,0,0,0.3);
    animation: scaleIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
}

/* Header */
.modal-header {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 16px;
    color: #333;
    background: linear-gradient(135deg, #ff6b6b, #ff8c42);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Body text */
#deliveryText {
    font-size: 14px;
    color: #666;
    margin-bottom: 24px;
    line-height: 1.6;
}

/* Footer buttons */
.modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
}

/* Cancel button */
.close-modal {
    background: #f0f0f0;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    color: #666;
    transition: all 0.3s ease;
}

.close-modal:hover {
    background: #e0e0e0;
}

/* Confirm button */
.confirm-btn {
    background: linear-gradient(135deg, #ff6b6b, #ff8c42);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    transition: all 0.3s ease;
}

.confirm-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(255, 107, 107, 0.3);
}

/* Animation */
@keyframes scaleIn {
    from {
        transform: scale(0.85);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
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

    <!-- Categories -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h6 class="fw-semibold mb-3">
                <i class="bi bi-grid"></i> Categories
            </h6>

            <ul class="list-group list-group-flush">
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

    <!-- Filters (SAME WIDTH AS CATEGORIES) -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h6 class="fw-semibold mb-3">
                <i class="bi bi-funnel"></i> Filters
            </h6>

            <form method="get"
      action="<?= base_url('items_by_category/' . $selected_category_id) ?>">

    <!-- SEARCH -->
    <div class="mb-3">
        <label class="form-label small fw-semibold">Search Item</label>
        <input type="text"
               name="search"
               class="form-control form-control-sm"
               placeholder="Item name..."
               value="<?= esc($_GET['search'] ?? '') ?>">
    </div>

    <!-- IN STOCK -->
    <div class="form-check mb-3">
        <input class="form-check-input"
               type="checkbox"
               name="instock"
               value="1"
               <?= isset($_GET['instock']) ? 'checked' : '' ?>>
        <label class="form-check-label small">
            In Stock Only
        </label>
    </div>

    <!-- PRICE SORT -->
    <div class="mb-3">
        <label class="form-label small fw-semibold">Price Sort</label>
        <select name="price_sort" class="form-select form-select-sm">
            <option value="">Default</option>
            <option value="price_asc"
                <?= ($_GET['price_sort'] ?? '') === 'price_asc' ? 'selected' : '' ?>>
                Low → High
            </option>
            <option value="price_desc"
                <?= ($_GET['price_sort'] ?? '') === 'price_desc' ? 'selected' : '' ?>>
                High → Low
            </option>
        </select>
    </div>

    <button type="submit" class="btn btn-sm btn-primary w-100">
        Apply Filters
    </button>
</form>

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
                  location.reload(true); 
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
