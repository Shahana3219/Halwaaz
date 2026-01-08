<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Halwaaz | Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: #f7f7f7;
    margin: 0;
}

/* ================= SPLASH SCREEN ================= */
#splash-screen {
    position: fixed;
    inset: 0;
    background: linear-gradient(135deg, #d9c7c7ff, #ff0844);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.splash-content {
    text-align: center;
    color: #fff;
    animation: splashFade 2.5s ease forwards;
}

.splash-content img {
    width: 120px;
    margin-bottom: 20px;
    animation: logoPop 1.5s ease;
}

.splash-content h2 {
    font-size: 28px;
    margin: 0;
    font-weight: 600;
}
.container {
    padding-left: 8px;
    padding-right: 8px;
}

.splash-content p {
    margin-top: 8px;
    font-size: 14px;
    opacity: 0.9;
}

/* Splash animations */
@keyframes logoPop {
    0% { transform: scale(0.5); opacity: 0; }
    60% { transform: scale(1.1); opacity: 1; }
    100% { transform: scale(1); }
}

@keyframes splashFade {
    0% { opacity: 1; }
    80% { opacity: 1; }
    100% { opacity: 0; }
}

/* ================= HERO ================= */
.hero {
    height: 380px;
    background: url("<?= base_url('public/images/hero.jpg') ?>") center/cover no-repeat;
    position: relative;
}
.hero::after {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.45);
}
.hero-text {
    position: relative;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: #fff;
    text-align: center;
    z-index: 1;
}

/* ================= CATEGORY CARDS ================= */

.category-card:hover {
    transform: translateY(-6px);
}
.category-card img {
    height: 220px;
    object-fit: cover;
}
.category-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.65), transparent);
    display: flex;
    align-items: flex-end;
    padding: 18px;
    color: #fff;

}
.categoryDropdown {
    position: absolute;
    background: #fff;
    list-style: none;
    padding: 8px 0;
    margin: 0;
    min-width: 200px;
    display: block;
    z-index: 999;
}

html, body {
    overflow-x: hidden;
}

/* TRUE EDGE-TO-EDGE CATEGORY GRID */
.category-row {
    margin-left: 0;
    margin-right: 0;
}

.category-row > [class*="col-"] {
    padding: 6px; /* space BETWEEN cards only */
}
.category-card {
    border-radius: 20px;
}

.category-overlay h6 {
    font-size: 1rem;
    font-weight: 600;
}

</style>
</head>

<body>

<!-- ================= SPLASH SCREEN ================= -->
<div id="splash-screen">
    <div class="splash-content">
        <!-- Replace with your logo image -->
        <img src="<?= base_url('public/images/logo.png') ?>" alt="Halwaaz Logo">
        <h2>Welcome to Halwaaz</h2>
        <p>Sweet & Delicious Halwa World</p>
    </div>
</div>

<!-- ================= MAIN CONTENT ================= -->
<div id="main-content" style="display:none;">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
<div class="container">
    <a class="navbar-brand fw-semibold text-primary" href="#">
        <i class="bi bi-shop"></i> Halwaaz
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav ms-auto gap-lg-3 align-items-lg-center">

                    <!-- CATEGORY DROPDOWN -->
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="categorybtn"
       role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-grid"></i> Categories
    </a>

    <ul class="dropdown-menu" id="category_list">
        <li class="dropdown-item text-muted">Loading...</li>
    </ul>
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
                    <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> View Profile</a></li>
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

<!-- HERO -->
<div class="hero">
    <div class="hero-text">
        <h1 class="fw-semibold">Sweet & Delicious Halwa World</h1>
        <p>Welcome to Halwaaz</p>
    </div>
</div>
<!-- CATEGORIES -->
<div class="container-fluid py-5">

    <h3 class="text-center mb-4">Explore Sweet Categories</h3>

    <div class="row category-row">

        <div class="col-md-3">
            <div class="position-relative category-card">
                <img src="<?= base_url('public/images/halwa1.jpg') ?>" class="w-100">
                <div class="category-overlay"><h6>Classic Halwa</h6></div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="position-relative category-card">
                <img src="<?= base_url('public/images/halwa2.jpg') ?>" class="w-100">
                <div class="category-overlay"><h6>Dry Fruit Halwa</h6></div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="position-relative category-card">
                <img src="<?= base_url('public/images/halwa3.jpg') ?>" class="w-100">
                <div class="category-overlay"><h6>Exotic Flavours</h6></div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="position-relative category-card">
                <img src="<?= base_url('public/images/halwa4.jpg') ?>" class="w-100">
                <div class="category-overlay"><h6>Fruit Halwa</h6></div>
            </div>
        </div>

    </div>
</div>
<section class="bg-white py-5">
  <div class="container">
    <div class="row text-center g-4">
      <div class="col-md-3">
        <i class="bi bi-award fs-1 text-danger"></i>
        <h6 class="mt-3 fw-semibold">Premium Quality</h6>
        <p class="small text-muted">Only the finest ingredients</p>
      </div>
      <div class="col-md-3">
        <i class="bi bi-clock-history fs-1 text-danger"></i>
        <h6 class="mt-3 fw-semibold">Fresh Daily</h6>
        <p class="small text-muted">Prepared every morning</p>
      </div>
      <div class="col-md-3">
        <i class="bi bi-truck fs-1 text-danger"></i>
        <h6 class="mt-3 fw-semibold">Fast Delivery</h6>
        <p class="small text-muted">Doorstep delivery</p>
      </div>
      <div class="col-md-3">
        <i class="bi bi-heart fs-1 text-danger"></i>
        <h6 class="mt-3 fw-semibold">Loved by Customers</h6>
        <p class="small text-muted">1000+ happy orders</p>
      </div>
    </div>
  </div>
</section>
<section class="py-5 bg-light">
  <div class="container">
    <h4 class="text-center mb-4 fw-semibold">Popular Picks</h4>

    <div class="row g-4">
      <div class="col-md-4">
        <div class="card border-0 shadow-sm">
          <img src="<?= base_url('public/images/halwa1.jpg') ?>" class="card-img-top">
          <div class="card-body text-center">
            <h6 class="fw-semibold">Classic Ghee Halwa</h6>
            <p class="text-muted small">Best seller</p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card border-0 shadow-sm">
          <img src="<?= base_url('public/images/halwa2.jpg') ?>" class="card-img-top">
          <div class="card-body text-center">
            <h6 class="fw-semibold">Dry Fruit Halwa</h6>
            <p class="text-muted small">Customer favourite</p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card border-0 shadow-sm">
          <img src="<?= base_url('public/images/halwa3.jpg') ?>" class="card-img-top">
          <div class="card-body text-center">
            <h6 class="fw-semibold">Exotic Mix Halwa</h6>
            <p class="text-muted small">Limited edition</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="py-5 bg-white">
  <div class="container">
    <h4 class="text-center mb-4 fw-semibold">What Our Customers Say</h4>

    <div class="row g-4">
      <div class="col-md-4">
        <div class="p-4 shadow-sm rounded bg-light">
          <p class="small text-muted">“Best halwa I’ve ever tasted. Fresh and rich!”</p>
          <h6 class="fw-semibold mb-0">– Ayesha</h6>
        </div>
      </div>

      <div class="col-md-4">
        <div class="p-4 shadow-sm rounded bg-light">
          <p class="small text-muted">“Perfect sweetness and fast delivery.”</p>
          <h6 class="fw-semibold mb-0">– Rahman</h6>
        </div>
      </div>

      <div class="col-md-4">
        <div class="p-4 shadow-sm rounded bg-light">
          <p class="small text-muted">“Halwaaz is now our family favorite.”</p>
          <h6 class="fw-semibold mb-0">– Suresh</h6>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="py-5 text-white text-center" style="background: linear-gradient(135deg,#ff0844,#ffb347);">
  <div class="container">
    <h4 class="fw-semibold">Get Sweet Offers in Your Inbox</h4>
    <p class="small opacity-75">Exclusive deals & festive specials</p>

    <form class="d-flex justify-content-center gap-2 mt-3">
      <input type="email" class="form-control w-50" placeholder="Enter your email">
      <button class="btn btn-dark px-4">Subscribe</button>
    </form>
  </div>
</section>
<footer class="bg-dark text-light pt-5">
  <div class="container">
    <div class="row g-4">

      <div class="col-md-4">
        <h5 class="fw-semibold">Halwaaz</h5>
        <p class="small text-muted">
          Sweet & Delicious Halwa World. Crafted with love and tradition.
        </p>
      </div>

      <div class="col-md-2">
        <h6 class="fw-semibold">Quick Links</h6>
        <ul class="list-unstyled small">
          <li><a href="#" class="text-muted text-decoration-none">Home</a></li>
          <li><a href="#" class="text-muted text-decoration-none">Categories</a></li>
          <li><a href="#" class="text-muted text-decoration-none">Orders</a></li>
        </ul>
      </div>

      <div class="col-md-3">
        <h6 class="fw-semibold">Contact</h6>
        <p class="small text-muted mb-1">📍 India</p>
        <p class="small text-muted mb-1">📞 +91 XXXXX XXXXX</p>
        <p class="small text-muted">✉ support@halwaaz.com</p>
      </div>

      <div class="col-md-3">
        <h6 class="fw-semibold">Follow Us</h6>
        <div class="d-flex gap-3 fs-5">
          <i class="bi bi-instagram"></i>
          <i class="bi bi-facebook"></i>
          <i class="bi bi-whatsapp"></i>
        </div>
      </div>

    </div>

    <hr class="border-secondary mt-4">

    <p class="text-center small text-muted mb-0 pb-3">
      © <?= date('Y') ?> Halwaaz. All rights reserved.
    </p>
  </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Splash control -->
<script>
window.addEventListener('load', function () {
    setTimeout(function () {
        document.getElementById('splash-screen').style.display = 'none';
        document.getElementById('main-content').style.display = 'block';
    }, 2500);
});
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function () {

    $('#categorybtn').on('click', function () {

        $.ajax({
            url: "<?= base_url('/get_categories') ?>",
            type: "POST",
            dataType: "json",
            success: function (response) {

                $('#category_list').empty();

                if (!response.length) {
                    $('#category_list').append(
                        '<li class="dropdown-item text-muted">No categories</li>'
                    );
                return;
                }

                response.forEach(function (row) {
                    $('#category_list').append(
                        '<li>' +
                        '<a class="dropdown-item" href="<?=base_url('items_by_category')?>/' +row.id +'">'+
                         row.name + 
                        '</a>'
                           +
                        '</li>'
                    );
                });
            }
        });

    });

});
</script>


</body>
</html>
