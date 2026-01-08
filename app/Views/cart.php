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
