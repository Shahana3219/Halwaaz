<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Halwaaz | Shopping Cart</title>
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
            background: white;
            border-radius: 16px;
            padding: 30px;
            margin-top: 24px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .container h2 {
            color: #333;
            font-weight: 700;
            margin-bottom: 24px;
        }

        .table {
            background: white;
        }

        .table thead {
            background: linear-gradient(90deg, #ff6b6b 0%, #ff8c42 100%);
            color: white;
            font-weight: 600;
            border: none;
        }

        .table thead th {
            border: none;
            padding: 14px;
            font-size: 13px;
        }

        .table tbody td {
            border: 1px solid #f0f0f0;
            padding: 14px;
            vertical-align: middle;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background: #f8f9fa;
        }

        .table img {
            border-radius: 10px;
        }

        .btn {
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-success {
            background: linear-gradient(135deg, #34d399 0%, #10b981 100%);
            border: none;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(52, 211, 153, 0.3);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }

        .cart-plus, .cart-minus, .cart_remove {
            background: #f0f0f0;
            border: none;
            border-radius: 6px;
            padding: 6px 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            color: #333;
        }

        .cart-plus:hover, .cart-minus:hover {
            background: linear-gradient(135deg, #ff8c42, #ff6b6b);
            color: white;
        }

        .cart_remove {
            background: #ffe5e5;
            color: #ff6b6b;
        }

        .cart_remove:hover {
            background: #ff6b6b;
            color: white;
        }

        .buy-btn {
            background: linear-gradient(135deg, #34d399, #10b981);
            border: none;
            color: white;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .buy-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(52, 211, 153, 0.3);
        }

        .table tr:last-child {
            background: linear-gradient(90deg, #fff8f8, #fff5f0);
            font-weight: 700;
            font-size: 16px;
        }

        .table tr:last-child strong {
            color: #ff8c42;
        }

/* Overlay */
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

<div class="container mt-5">
    <h2>Your Cart</h2>

    <?php if (!empty($cart)): ?>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Item Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total = 0;
                foreach($cart as $item): 
                    $subtotal = $item['amount'] * $item['quantity'];
                    $total += $subtotal;
                ?>
                <tr>
                    <td><img src="<?= base_url('public/images/' . $item['image']) ?>" width="60" alt="<?= $item['name'] ?>"></td>
                    <td><?= $item['name'] ?></td>
                    <td>₹ <?= number_format($item['amount'], 2) ?></td>
                    <td><span class="item-quantity" data-cartid="<?= $item['cart_id'] ?>"><?= $item['quantity'] ?></span></td>
                    <td>₹ <span class="item-subtotal" data-cartid="<?= $item['cart_id'] ?>"><?= number_format($subtotal, 2) ?></span></td>

                    <td>

                                <!-- ADDD BUTTON -->
                        <button class="btn cart-plus" data-id="<?= $item['cart_id'] ?>">+</button>

                        <button class="btn cart-minus" data-id="<?= $item['cart_id'] ?>">-</button>
                     
                     
                        <button 
    class="btn cart_remove"
    data-id="<?= $item['cart_id'] ?>"
>
    Remove
</button>

<button class="btn btn-success buy-btn" data-itemid="<?= $item['item_id'] ?>"
>
    Buy
</button>





                    </td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4" class="text-end"><strong>Total:</strong></td>
                    <td colspan="2"><strong>₹ <?= number_format($total, 2) ?></strong></td>
                </tr>
            </tbody>
        </table>

        <a href="#" class="btn btn-success">Proceed to Checkout</a>
        <a href="<?=base_url('home')?>" class="btn btn-primary">Continue Shopping</a>

    <?php else: ?>
        <p>Your cart is empty.</p>
        <a href="<?=base_url('home')?>" class="btn btn-primary">Shop Now</a>
    <?php endif; ?>

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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
  $(document).ready(function(){

    //UPDATE qTY, subtotal, and total in the cart table
    // [refreshing whole page makes time so used this method]
    
    function updateCartUI(cartId, quantity, subtotal) {
        // Updating the quantity for the specific cart item
        $('.item-quantity[data-cartid="'+cartId+'"]').text(quantity);
        // Updating the subtotal for the specific cart item
        $('.item-subtotal[data-cartid="'+cartId+'"]').text(subtotal.toFixed(2));
        // Recalculate the total for all items in the cart
        let total = 0;
        $('.item-subtotal').each(function(){
            total += parseFloat($(this).text()); // Add each item's subtotal
        });
        // Update the total value in the table footer
        $('tr:last td strong').last().text('₹ ' + total.toFixed(2));
    }

});

        //ADDING
        $(document).on('click','.cart-plus',function(){
            let cartId=$(this).data('id');

            $.ajax({
                url:"<?=base_url('cart_plus')?>",
                type:"POST",
                data:{
                    cart_id:cartId
                },
                dataType:"json",
                success:function(response){
                    location.reload();
                }
            });
    });
            //MINUSS
        $(document).on('click','.cart-minus',function(){
            let cartId=$(this).data('id');

            $.ajax({
                url:"<?=base_url('cart_minus')?>",
                type:"POST",
                data:{
                    cart_id:cartId
                },
                dataType:"json",
                success:function(response){
                    location.reload();
                }
            });
    });
          //REMOVING
    $(document).on('click','.cart_remove',function(){
        let cartId = $(this).data('id');

        $.ajax({
            url:"<?= base_url('cart_remove') ?>",
            type:"POST",
            data:
            {
                 cart_id: cartId 
            },
            dataType:"json",
            success:function(){
                location.reload();
            }
        });
    });
         
// OPEN MODAL
let buyItemId = null;
let buyQuantity = 1;
$(document).on('click', '.buy-btn', function () {
    buyItemId = $(this).data('itemid');
    buyQuantity = parseInt($(this).closest('tr').find('.item-quantity').text()); // get current quantity
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
            item_id:buyItemId,
            quantity: buyQuantity
        },
        success: function (response) {

            if (response.status === 'success') {
                $('#buyModal').fadeOut(function() {
                    // After fadeOut completes, redirect to cart
                    window.location.href = "<?= base_url('cart') ?>";
                });
        
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
