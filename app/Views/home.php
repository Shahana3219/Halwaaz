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
    background: linear-gradient(135deg, #f5f7fa 0%, #f0f4f8 100%);
    margin: 0;
    color: #333;
}

/* ================= SPLASH SCREEN ================= */
#splash-screen {
    position: fixed;
    inset: 0;
    background: linear-gradient(135deg, #ff6b6b 0%, #ff8c42 50%, #ffd93d 100%);
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
    filter: drop-shadow(0 10px 25px rgba(0,0,0,0.2));
}

.splash-content h2 {
    font-size: 32px;
    margin: 0;
    font-weight: 700;
    letter-spacing: -0.5px;
}
.container {
    padding-left: 8px;
    padding-right: 8px;
}

.splash-content p {
    margin-top: 8px;
    font-size: 16px;
    opacity: 0.95;
    font-weight: 300;
}

/* Splash animations */
@keyframes logoPop {
    0% { transform: scale(0.5); opacity: 0; }
    60% { transform: scale(1.15); opacity: 1; }
    100% { transform: scale(1); }
}

@keyframes splashFade {
    0% { opacity: 1; }
    80% { opacity: 1; }
    100% { opacity: 0; visibility: hidden; }
}

/* ================= NAVBAR ================= */
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
    position: relative;
}

.nav-link:hover {
    color: #ff8c42 !important;
}

.nav-link i {
    margin-right: 6px;
}

/* ================= HERO ================= */
.hero {
    height: 450px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%), url("<?= base_url('public/images/hero.jpg') ?>") center/cover;
    background-blend-mode: overlay;
    position: relative;
    overflow: hidden;
}

.hero::before {
    content: "";
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 20% 50%, rgba(255,107,107,0.15), transparent),
                radial-gradient(circle at 80% 80%, rgba(255,140,66,0.15), transparent);
}

.hero::after {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.35);
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
    z-index: 2;
}

.hero-text h1 {
    font-size: 48px;
    font-weight: 700;
    margin-bottom: 12px;
    text-shadow: 0 4px 12px rgba(0,0,0,0.3);
    letter-spacing: -1px;
}

.hero-text p {
    font-size: 20px;
    opacity: 0.95;
    font-weight: 300;
    text-shadow: 0 2px 8px rgba(0,0,0,0.2);
}

/* ================= CATEGORY CARDS ================= */

.category-card {
    border-radius: 18px;
    overflow: hidden;
    position: relative;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
    box-shadow: 0 8px 24px rgba(0,0,0,0.12);
}

.category-card:hover {
    transform: translateY(-12px) scaleX(1.02);
    box-shadow: 0 16px 40px rgba(0,0,0,0.2);
}

.category-card img {
    height: 240px;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.category-card:hover img {
    transform: scale(1.1);
}

.category-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.3) 50%, transparent);
    display: flex;
    align-items: flex-end;
    padding: 24px;
    color: #fff;
    transition: all 0.4s ease;
}

.category-overlay h6 {
    font-size: 18px;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 8px rgba(0,0,0,0.3);
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
    border-radius: 10px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.15);
}

html, body {
    overflow-x: hidden;
    scroll-behavior: smooth;
}

/* Smooth fade-in animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.category-card, .product-card, .feature-card {
    animation: fadeInUp 0.6s ease-out forwards;
}

.category-card { animation-delay: 0.1s; }
.category-card:nth-child(2) { animation-delay: 0.2s; }
.category-card:nth-child(3) { animation-delay: 0.3s; }
.category-card:nth-child(4) { animation-delay: 0.4s; }

/* TRUE EDGE-TO-EDGE CATEGORY GRID */
.category-row {
    margin-left: 0;
    margin-right: 0;
}

.category-row > [class*="col-"] {
    padding: 8px;
}

.category-card {
    border-radius: 18px;
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
        <div class="feature-card p-4 rounded-3" style="background: linear-gradient(135deg, #ffe66d 0%, #ffd93d 100%); transition: all 0.3s ease;">
          <div class="feature-icon mb-3">
            <i class="bi bi-award fs-1" style="color: #fff;"></i>
          </div>
          <h6 class="mt-3 fw-semibold" style="color: #fff;">Premium Quality</h6>
          <p class="small" style="color: rgba(255,255,255,0.9);">Only the finest ingredients</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="feature-card p-4 rounded-3" style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%); transition: all 0.3s ease;">
          <div class="feature-icon mb-3">
            <i class="bi bi-clock-history fs-1" style="color: #fff;"></i>
          </div>
          <h6 class="mt-3 fw-semibold" style="color: #fff;">Fresh Daily</h6>
          <p class="small" style="color: rgba(255,255,255,0.9);">Prepared every morning</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="feature-card p-4 rounded-3" style="background: linear-gradient(135deg, #ff9a56 0%, #ff6b9d 100%); transition: all 0.3s ease;">
          <div class="feature-icon mb-3">
            <i class="bi bi-truck fs-1" style="color: #fff;"></i>
          </div>
          <h6 class="mt-3 fw-semibold" style="color: #fff;">Fast Delivery</h6>
          <p class="small" style="color: rgba(255,255,255,0.9);">Doorstep delivery in 3 days</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="feature-card p-4 rounded-3" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); transition: all 0.3s ease;">
          <div class="feature-icon mb-3">
            <i class="bi bi-heart fs-1" style="color: #fff;"></i>
          </div>
          <h6 class="mt-3 fw-semibold" style="color: #fff;">Loved by Customers</h6>
          <p class="small" style="color: rgba(255,255,255,0.9);">1000+ happy orders</p>
        </div>
      </div>
    </div>
  </div>

  <style>
    .feature-card {
      cursor: pointer;
      transform: translateY(0);
      box-shadow: 0 8px 24px rgba(0,0,0,0.1);
    }
    
    .feature-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 16px 40px rgba(0,0,0,0.15);
    }
    
    .feature-icon {
      display: inline-block;
      width: 70px;
      height: 70px;
      background: rgba(255,255,255,0.2);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
    }
  </style>
</section>
<section class="py-5" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);">
  <div class="container">
    <div class="text-center mb-5">
      <h4 class="fw-semibold" style="font-size: 32px; color: #333;">Popular Picks</h4>
      <p class="text-muted">Our most loved halwa flavors</p>
    </div>

    <div class="row g-5">
      <div class="col-md-4">
        <div class="product-card" style="border-radius: 16px; overflow: hidden; background: white; box-shadow: 0 8px 24px rgba(0,0,0,0.1); transition: all 0.4s ease; cursor: pointer;">
          <div class="product-image-wrapper" style="height: 260px; overflow: hidden; background: #f0f0f0; position: relative;">
            <img src="<?= base_url('public/images/halwa1.jpg') ?>" class="w-100 h-100" style="object-fit: cover; transition: transform 0.5s ease;">
            <div style="position: absolute; top: 12px; right: 12px; background: linear-gradient(135deg, #ff6b6b, #ff8c42); color: white; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Top Seller</div>
          </div>
          <div class="card-body text-center p-4">
            <h6 class="fw-bold" style="font-size: 18px; color: #333;">Classic Ghee Halwa</h6>
            <p class="text-muted small mb-3">Best seller - Authentic taste</p>
            <div style="display: flex; gap: 8px; justify-content: center; margin-top: 12px;">
              <i class="bi bi-star-fill" style="color: #ffc107;"></i>
              <i class="bi bi-star-fill" style="color: #ffc107;"></i>
              <i class="bi bi-star-fill" style="color: #ffc107;"></i>
              <i class="bi bi-star-fill" style="color: #ffc107;"></i>
              <i class="bi bi-star-half" style="color: #ffc107;"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="product-card" style="border-radius: 16px; overflow: hidden; background: white; box-shadow: 0 8px 24px rgba(0,0,0,0.1); transition: all 0.4s ease; cursor: pointer;">
          <div class="product-image-wrapper" style="height: 260px; overflow: hidden; background: #f0f0f0; position: relative;">
            <img src="<?= base_url('public/images/halwa2.jpg') ?>" class="w-100 h-100" style="object-fit: cover; transition: transform 0.5s ease;">
            <div style="position: absolute; top: 12px; right: 12px; background: linear-gradient(135deg, #667eea, #764ba2); color: white; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Favorite</div>
          </div>
          <div class="card-body text-center p-4">
            <h6 class="fw-bold" style="font-size: 18px; color: #333;">Dry Fruit Halwa</h6>
            <p class="text-muted small mb-3">Customer favorite - Premium</p>
            <div style="display: flex; gap: 8px; justify-content: center; margin-top: 12px;">
              <i class="bi bi-star-fill" style="color: #ffc107;"></i>
              <i class="bi bi-star-fill" style="color: #ffc107;"></i>
              <i class="bi bi-star-fill" style="color: #ffc107;"></i>
              <i class="bi bi-star-fill" style="color: #ffc107;"></i>
              <i class="bi bi-star-fill" style="color: #ffc107;"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="product-card" style="border-radius: 16px; overflow: hidden; background: white; box-shadow: 0 8px 24px rgba(0,0,0,0.1); transition: all 0.4s ease; cursor: pointer;">
          <div class="product-image-wrapper" style="height: 260px; overflow: hidden; background: #f0f0f0; position: relative;">
            <img src="<?= base_url('public/images/halwa3.jpg') ?>" class="w-100 h-100" style="object-fit: cover; transition: transform 0.5s ease;">
            <div style="position: absolute; top: 12px; right: 12px; background: linear-gradient(135deg, #f093fb, #f5576c); color: white; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Limited</div>
          </div>
          <div class="card-body text-center p-4">
            <h6 class="fw-bold" style="font-size: 18px; color: #333;">Exotic Mix Halwa</h6>
            <p class="text-muted small mb-3">Limited edition - Special blend</p>
            <div style="display: flex; gap: 8px; justify-content: center; margin-top: 12px;">
              <i class="bi bi-star-fill" style="color: #ffc107;"></i>
              <i class="bi bi-star-fill" style="color: #ffc107;"></i>
              <i class="bi bi-star-fill" style="color: #ffc107;"></i>
              <i class="bi bi-star-fill" style="color: #ffc107;"></i>
              <i class="bi bi-star" style="color: #ffc107;"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <style>
    .product-card {
      transform: translateY(0) scale(1);
    }
    
    .product-card:hover {
      transform: translateY(-12px) scale(1.02);
      box-shadow: 0 16px 40px rgba(0,0,0,0.15) !important;
    }
    
    .product-card:hover .product-image-wrapper img {
      transform: scale(1.1);
    }
  </style>
</section>
<section class="py-5" style="background: linear-gradient(135deg, #f5f7fa 0%, #f0f4f8 100%);">
  <div class="container">
    <div class="text-center mb-5">
      <h4 class="fw-semibold" style="font-size: 32px; color: #333;">What Our Customers Say</h4>
      <p class="text-muted">Join thousands of happy customers</p>
    </div>

    <div class="row g-4">
      <div class="col-md-4">
        <div class="p-4 rounded-3" style="background: white; box-shadow: 0 8px 20px rgba(0,0,0,0.08); border-left: 4px solid #ff6b6b;">
          <div style="display: flex; gap: 2px; margin-bottom: 12px;">
            <i class="bi bi-star-fill" style="color: #ffc107;"></i>
            <i class="bi bi-star-fill" style="color: #ffc107;"></i>
            <i class="bi bi-star-fill" style="color: #ffc107;"></i>
            <i class="bi bi-star-fill" style="color: #ffc107;"></i>
            <i class="bi bi-star-fill" style="color: #ffc107;"></i>
          </div>
          <p class="small text-muted mb-3" style="font-style: italic;">"Best halwa I've ever tasted. Fresh and rich!"</p>
          <h6 class="fw-bold mb-0" style="color: #333;">Ayesha Khan</h6>
          <p class="text-muted small mb-0">Verified Customer</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="p-4 rounded-3" style="background: white; box-shadow: 0 8px 20px rgba(0,0,0,0.08); border-left: 4px solid #667eea;">
          <div style="display: flex; gap: 2px; margin-bottom: 12px;">
            <i class="bi bi-star-fill" style="color: #ffc107;"></i>
            <i class="bi bi-star-fill" style="color: #ffc107;"></i>
            <i class="bi bi-star-fill" style="color: #ffc107;"></i>
            <i class="bi bi-star-fill" style="color: #ffc107;"></i>
            <i class="bi bi-star-fill" style="color: #ffc107;"></i>
          </div>
          <p class="small text-muted mb-3" style="font-style: italic;">"Perfect sweetness and fast delivery."</p>
          <h6 class="fw-bold mb-0" style="color: #333;">Rahman Ali</h6>
          <p class="text-muted small mb-0">Verified Customer</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="p-4 rounded-3" style="background: white; box-shadow: 0 8px 20px rgba(0,0,0,0.08); border-left: 4px solid #f5576c;">
          <div style="display: flex; gap: 2px; margin-bottom: 12px;">
            <i class="bi bi-star-fill" style="color: #ffc107;"></i>
            <i class="bi bi-star-fill" style="color: #ffc107;"></i>
            <i class="bi bi-star-fill" style="color: #ffc107;"></i>
            <i class="bi bi-star-fill" style="color: #ffc107;"></i>
            <i class="bi bi-star-half" style="color: #ffc107;"></i>
          </div>
          <p class="small text-muted mb-3" style="font-style: italic;">"Halwaaz is now our family favorite."</p>
          <h6 class="fw-bold mb-0" style="color: #333;">Suresh Patel</h6>
          <p class="text-muted small mb-0">Verified Customer</p>
        </div>
      </div>
    </div>
  </div>

  <style>
    .testimonial-card:hover { transform: translateY(-8px); }
  </style>
</section>
<section class="py-5 text-white text-center" style="background: linear-gradient(135deg, #ff6b6b 0%, #ff8c42 50%, #ffd93d 100%);">
  <div class="container">
    <h4 class="fw-semibold" style="font-size: 28px;">Get Sweet Offers in Your Inbox</h4>
    <p class="small" style="opacity: 0.95;">Exclusive deals & festive specials for our subscribers</p>

    <form class="d-flex justify-content-center gap-3 mt-4 flex-wrap">
      <input type="email" class="form-control" style="max-width: 350px; border: none; border-radius: 8px; padding: 12px 18px; font-size: 14px;" placeholder="Enter your email">
      <button class="btn" style="background: white; color: #ff6b6b; font-weight: 600; padding: 12px 32px; border-radius: 8px; border: none; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">Subscribe</button>
    </form>
  </div>
</section>
<footer class="text-light pt-5" style="background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%); position: relative;">
  <div class="container">
    <div class="row g-5">

      <div class="col-md-4">
        <h5 class="fw-bold mb-3" style="font-size: 20px; background: linear-gradient(135deg, #ff6b6b, #ff8c42); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Halwaaz</h5>
        <p class="small" style="color: #aaa; line-height: 1.6;">
          Sweet & Delicious Halwa World. Crafted with love, tradition, and premium ingredients for your special moments.
        </p>
        <div style="display: flex; gap: 12px; margin-top: 16px;">
          <div style="width: 40px; height: 40px; background: rgba(255,107,107,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.3s ease;"><i class="bi bi-instagram" style="color: #ff6b6b;"></i></div>
          <div style="width: 40px; height: 40px; background: rgba(102,126,234,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.3s ease;"><i class="bi bi-facebook" style="color: #667eea;"></i></div>
          <div style="width: 40px; height: 40px; background: rgba(52,211,153,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.3s ease;"><i class="bi bi-whatsapp" style="color: #34d399;"></i></div>
        </div>
      </div>

      <div class="col-md-2">
        <h6 class="fw-bold mb-4" style="color: #fff;">Quick Links</h6>
        <ul class="list-unstyled small">
          <li class="mb-2"><a href="<?= base_url('/') ?>" style="color: #aaa; text-decoration: none; transition: all 0.3s ease;" onmouseover="this.style.color='#ff8c42'" onmouseout="this.style.color='#aaa'"><i class="bi bi-arrow-up"></i> Back to Top</a></li>
          <li class="mb-2"><a href="#" style="color: #aaa; text-decoration: none; transition: all 0.3s ease;" onmouseover="this.style.color='#ff8c42'" onmouseout="this.style.color='#aaa'"><i class="bi bi-shield-check"></i> Privacy Policy</a></li>
          <li><a href="#" style="color: #aaa; text-decoration: none; transition: all 0.3s ease;" onmouseover="this.style.color='#ff8c42'" onmouseout="this.style.color='#aaa'"><i class="bi bi-file-text"></i> Terms & Conditions</a></li>
        </ul>
      </div>

      <div class="col-md-3">
        <h6 class="fw-bold mb-4" style="color: #fff;">Contact Info</h6>
        <div class="small" style="color: #aaa; line-height: 2;">
          <p class="mb-2"><i class="bi bi-geo-alt-fill" style="color: #ff8c42; margin-right: 8px;\"></i>India</p>
          <p class="mb-2"><i class="bi bi-telephone-fill\" style="color: #ff8c42; margin-right: 8px;\"></i>+91 XXXXX XXXXX</p>
          <p><i class="bi bi-envelope-fill\" style="color: #ff8c42; margin-right: 8px;\"></i>support@halwaaz.com</p>
        </div>
      </div>

      <div class="col-md-3">
        <h6 class="fw-bold mb-4\" style="color: #fff;\">Business Hours</h6>
        <div class="small\" style="color: #aaa; line-height: 2;\">
          <p class=\"mb-2\"><i class=\"bi bi-calendar3\" style=\"color: #ff8c42; margin-right: 8px;\"></i>Mon - Sun</p>
          <p class=\"mb-2\"><i class=\"bi bi-clock\" style=\"color: #ff8c42; margin-right: 8px;\"></i>8:00 AM - 10:00 PM</p>
          <p><span style=\"display: inline-block; background: #34d399; color: white; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;\">Always Open</span></p>
        </div>
      </div>

    </div>

    <hr class=\"border-secondary mt-5\">

    <p class=\"text-center small\" style=\"color: #666; margin-bottom: 0; padding-bottom: 24px;\">
      © <?= date('Y') ?> <span style=\"background: linear-gradient(135deg, #ff6b6b, #ff8c42); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 600;\">Halwaaz</span> • All rights reserved • Crafted with <i class=\"bi bi-heart-fill\" style=\"color: #ff6b6b;\"></i> for sweet lovers
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
