@extends('layouts.app')
@section('title', 'TT UNIK IT SOLUTIONS | E COMMERCE')
@section('description', 'TT UNIK IT SOLUTIONS provide Work Integrated Learning which is designed for ICT, MEDIA, FINANCE AND BUSINESS ADMINISTRATION. ')
@section('keywords', 'Work Integrated Learning, WIL, TUT WIL, UNISA WIL, UJ WIL')
@section('content')

<style>

.product-image{

    height:260px;
    width:100%;
    object-fit:contain;
    padding:20px;
    background:#fff;
}

.product-card{
    overflow:hidden;
}

.product-card:hover .product-image{

    transform:scale(1.05);
    transition:.4s;
}

/* ===== Floating Cart Button ===== */

.floating-cart-btn{
    position: fixed;
    top: 200px;
    right: 0px;
    z-index: 9999; 
}
 
.cart-count-badge{
    position:fixed;
    top:-4px;
    right:-4px;
    font-size:11px;
    min-width:20px;
    height:20px;
    display:flex;
    align-items:center;
    justify-content:center;
}

#cartCountBadge{
    position: fixed;
    top : 195px;
    z-index: 9999; 
    
}
 
/* Cart item row */

.cart-item-row{
    display:flex;
    gap:12px;
    padding:10px 0;
    border-bottom:1px solid #eee;
}
 
.cart-item-row img{
    width:56px;
    height:56px;
    object-fit:contain;
    background:#f5f5f5;
    border-radius:6px;
}
 
.cart-item-info{
    flex:1;
}
 
.cart-item-info h6{
    font-size:13px;
    margin-bottom:4px;
}
 
.cart-qty-control{
    display:flex;
    align-items:center;
    gap:6px;
}
 
.cart-qty-control button{
    width:24px;
    height:24px;
    border:1px solid #ddd;
    background:#fff;
    border-radius:4px;
    line-height:1;
    font-size:14px;
    cursor:pointer;
}
 
.cart-remove-btn{
    background:none;
    border:none;
    color:#dc3545;
    font-size:13px;
    cursor:pointer;
}

/* ===== Quick View Modal ===== */
#quickViewModal .modal-dialog{
    max-width: 1000px; /* make the whole card bigger — adjust this number freely */
    max-height: 400px !important;
}

#quickViewModal .modal-body{
    padding:0;
}

.qv-image-side{
    background:#f5f6fa;
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    padding:30px;
    min-height:420px;
    border-radius: 15px;
}

.qv-main-image-wrap{
    width:90%;
    display:flex;
    align-items:center;
    justify-content:center;
    min-height:300px;
    
}

.qv-image-side img.qv-main{
    max-width:100%;
    max-height:320px;
    object-fit:contain;
}

.qv-thumb-strip{
    display:flex;
    gap:10px;
    margin-top:18px;
    flex-wrap:wrap;
    justify-content:center;
}

.qv-thumb{
    width:56px;
    height:56px;
    object-fit:contain;
    background:#fff;
    border:2px solid #e2e5eb;
    border-radius:8px;
    padding:4px;
    cursor:pointer;
    transition:border-color .15s ease;
}

.qv-thumb:hover{
    border-color:#7c8aa3;
}

.qv-thumb.active{
    border-color: var(--bs-primary, #696cff);
}

.qv-info-side{
    padding:28px;
}

.qv-info-side h4{
    font-weight:600;
}

.qv-qty-control{
    display:flex;
    align-items:center;
    gap:10px;
}

.qv-qty-control button{
    width:36px;
    height:36px;
    border:1px solid #ddd;
    background:#fff;
    border-radius:6px;
    font-size:16px;
    cursor:pointer;
}

.qv-qty-control span{
    min-width:28px;
    text-align:center;
    font-weight:600;
}

@media (max-width: 767px){
    .qv-image-side{
        min-height:220px;
        padding:16px;
    }
}

</style>

<div class="row g-4">

    <!-- Products -->
    <div class="container-fluid col-xl-9 col-lg-8" style="margin-top: 25px;">
        <!-- ===================== FLOATING CART BUTTON ===================== -->
        <button
            type="button"
            id="floatingCartBtn"
            class="btn btn-primary rounded-circle shadow floating-cart-btn"
            data-bs-toggle="offcanvas"
            data-bs-target="#cartOffcanvas"
            aria-controls="cartOffcanvas"
            style="height: 50px; width: 50px;"
            >


            <i class="ti ti-shopping-cart" style="background-color: transparent; font-size: 22px;"></i>

        </button>
        <span id="cartCountBadge" class="badge rounded-pill bg-danger cart-count-badge">0</span>

        <!-- Toolbar -->
        <div class="card mb-3">
            <div class="card-body">

                <div class="row align-items-center">

                    <div class="col-md-5">

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="ti ti-search" style="background-color: transparent;"></i>
                            </span>

                            <input
                                type="text"
                                class="form-control"
                                placeholder="Search products...">
                        </div>

                    </div>

                    <div class="col-md-3 mt-3 mt-md-0">
                        <select class="form-select">
                            <option>Latest</option>
                            <option>Price Low - High</option>
                            <option>Price High - Low</option>
                            <option>Popular</option>
                        </select>
                    </div>

                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <small class="text-muted">
                            Showing 1-9 of 120 products
                        </small>
                    </div>

                </div>

            </div>
        </div>

        <!-- Product Grid -->
        <div class="row">

            @php
                // Placeholder demo data until real $products comes from the controller.
                $demoProducts = [
                    [
                        'id' => 1,
                        'name' => 'TP-Link Archer AX55',
                        'price' => 1799,
                        'rating' => 5.0,
                        'stock' => 'In Stock',
                        'description' => 'AX3000 dual-band Wi-Fi 6 router with OFDMA, MU-MIMO, and gigabit ports — ideal for home or small office networks needing fast, reliable coverage.'
                    ],
                    [
                        'id' => 2,
                        'name' => 'Dell Latitude 5440',
                        'price' => 14999,
                        'rating' => 4.5,
                        'stock' => 'In Stock',
                        'description' => 'Business-grade 14" laptop with Intel i5-1335U, 16GB RAM, and 512GB SSD. Built for reliability with Dell\'s ProSupport warranty options.'
                    ],
                    [
                        'id' => 3,
                        'name' => 'Lenovo ThinkPad E14',
                        'price' => 11499,
                        'rating' => 4.8,
                        'stock' => 'Low Stock',
                        'description' => 'AMD Ryzen 5 powered ThinkPad with 8GB RAM and 256GB SSD, known for its durable chassis and comfortable keyboard for everyday office work.'
                    ],
                    [
                        'id' => 3,
                        'name' => 'Lenovo ThinkPad E14',
                        'price' => 11499,
                        'rating' => 4.8,
                        'stock' => 'Low Stock',
                        'description' => 'AMD Ryzen 5 powered ThinkPad with 8GB RAM and 256GB SSD, known for its durable chassis and comfortable keyboard for everyday office work.'
                    ],
                    [
                        'id' => 3,
                        'name' => 'Lenovo ThinkPad E14',
                        'price' => 11499,
                        'rating' => 4.8,
                        'stock' => 'Low Stock',
                        'description' => 'AMD Ryzen 5 powered ThinkPad with 8GB RAM and 256GB SSD, known for its durable chassis and comfortable keyboard for everyday office work.'
                    ],
                    [
                        'id' => 3,
                        'name' => 'Lenovo ThinkPad E14',
                        'price' => 11499,
                        'rating' => 4.8,
                        'stock' => 'Low Stock',
                        'description' => 'AMD Ryzen 5 powered ThinkPad with 8GB RAM and 256GB SSD, known for its durable chassis and comfortable keyboard for everyday office work.'
                    ],
                    [
                        'id' => 3,
                        'name' => 'Lenovo ThinkPad E14',
                        'price' => 11499,
                        'rating' => 4.8,
                        'stock' => 'Low Stock',
                        'description' => 'AMD Ryzen 5 powered ThinkPad with 8GB RAM and 256GB SSD, known for its durable chassis and comfortable keyboard for everyday office work.'
                    ],
                    [
                        'id' => 3,
                        'name' => 'Lenovo ThinkPad E14',
                        'price' => 11499,
                        'rating' => 4.8,
                        'stock' => 'Low Stock',
                        'description' => 'AMD Ryzen 5 powered ThinkPad with 8GB RAM and 256GB SSD, known for its durable chassis and comfortable keyboard for everyday office work.'
                    ],
                    [
                        'id' => 3,
                        'name' => 'Lenovo ThinkPad E14',
                        'price' => 11499,
                        'rating' => 4.8,
                        'stock' => 'Low Stock',
                        'description' => 'AMD Ryzen 5 powered ThinkPad with 8GB RAM and 256GB SSD, known for its durable chassis and comfortable keyboard for everyday office work.'
                    ],
                    [
                        'id' => 3,
                        'name' => 'Lenovo ThinkPad E14',
                        'price' => 11499,
                        'rating' => 4.8,
                        'stock' => 'Low Stock',
                        'description' => 'AMD Ryzen 5 powered ThinkPad with 8GB RAM and 256GB SSD, known for its durable chassis and comfortable keyboard for everyday office work.'
                    ],
                    [
                        'id' => 3,
                        'name' => 'Lenovo ThinkPad E14',
                        'price' => 11499,
                        'rating' => 4.8,
                        'stock' => 'Low Stock',
                        'description' => 'AMD Ryzen 5 powered ThinkPad with 8GB RAM and 256GB SSD, known for its durable chassis and comfortable keyboard for everyday office work.'
                    ],
                    [
                        'id' => 3,
                        'name' => 'Lenovo ThinkPad E14',
                        'price' => 11499,
                        'rating' => 4.8,
                        'stock' => 'Low Stock',
                        'description' => 'AMD Ryzen 5 powered ThinkPad with 8GB RAM and 256GB SSD, known for its durable chassis and comfortable keyboard for everyday office work.'
                    ],
                    [
                        'id' => 3,
                        'name' => 'Lenovo ThinkPad E14',
                        'price' => 11499,
                        'rating' => 4.8,
                        'stock' => 'Low Stock',
                        'description' => 'AMD Ryzen 5 powered ThinkPad with 8GB RAM and 256GB SSD, known for its durable chassis and comfortable keyboard for everyday office work.'
                    ],
                    [
                        'id' => 3,
                        'name' => 'Lenovo ThinkPad E14',
                        'price' => 11499,
                        'rating' => 4.8,
                        'stock' => 'Low Stock',
                        'description' => 'AMD Ryzen 5 powered ThinkPad with 8GB RAM and 256GB SSD, known for its durable chassis and comfortable keyboard for everyday office work.'
                    ],
                ];
            @endphp

            @for($i = 1; $i <= 9; $i++)
                @php $p = $demoProducts[$i % 3]; @endphp

            <div class="col-xl-3 col-md-6 mb-4">

                <div class="card product-card h-100">

                    <div class="position-relative">

                       <img src="{{ asset('assets/img/ecommerce-images/laptop.png') }}"
                         class="card-img-top product-image"
                         alt="{{ $p['name'] }}">

                      <span class="badge bg-danger position-absolute top-0 start-0 m-3">
                         -15%
                      </span>

                    </div>

                    <div class="card-body">

                        <h5 class="mt-2">
                            {{ $p['name'] }}
                        </h5> 

                        <div class="mb-2">

                            <i class="ti ti-star" style="background-color: transparent; color: yellow; font-size: 15px;"></i>
                            <i class="ti ti-star" style="background-color: transparent; color: yellow; font-size: 15px;"></i>
                            <i class="ti ti-star" style="background-color: transparent; color: yellow; font-size: 15px;"></i>
                            <i class="ti ti-star" style="background-color: transparent; color: yellow; font-size: 15px;"></i>
                            <i class="ti ti-star" style="background-color: transparent; color: yellow; font-size: 15px;"></i>

                            <small class="text-muted">
                                  {{ $p['rating'] }}
                            </small>

                        </div>

                        <h4 class="text-primary mb-3">
                            R{{ number_format($p['price'], 0, '.', ' ') }}
                        </h4>

                        <span class="badge bg-label-success mb-3">
                            {{ $p['stock'] }}
                        </span>

                        <div class="d-grid">
                            <button
                                class="btn btn-primary quick-view-btn"
                                data-bs-toggle="modal"
                                data-bs-target="#quickViewModal"
                                data-id="{{ $p['id'] }}"
                                data-name="{{ $p['name'] }}"
                                data-price="{{ $p['price'] }}"
                                data-rating="{{ $p['rating'] }}"
                                data-stock="{{ $p['stock'] }}"
                                data-description="{{ $p['description'] }}"
                                data-image="{{ asset('assets/img/ecommerce-images/laptop.png') }}"
                                data-gallery="{{ asset('assets/img/ecommerce-images/laptop.png') }}|{{ asset('assets/img/ecommerce-images/laptop.png') }}|{{ asset('assets/img/ecommerce-images/laptop.png') }}">
                                <!-- data-gallery: pipe-separated image URLs. Swap these for real angle/detail
                                     photos once you have them (e.g. front.png|side.png|ports.png) -->
                                <i class="ti ti-shopping-cart me-1" style="background-color: transparent;"></i>
                                Add to Cart
                            </button>
                        </div>

                    </div>

                </div>

            </div>

            @endfor

        </div>

        <!-- Pagination -->

        <div class="d-flex justify-content-center mt-4">

            <nav>

                <ul class="pagination">

                    <li class="page-item disabled">
                        <a class="page-link">Previous</a>
                    </li>

                    <li class="page-item active">
                        <a class="page-link">1</a>
                    </li>

                    <li class="page-item">
                        <a class="page-link">2</a>
                    </li>

                    <li class="page-item">
                        <a class="page-link">3</a>
                    </li>

                    <li class="page-item">
                        <a class="page-link">Next</a>
                    </li>

                </ul>

            </nav>

        </div>
    </div>

</div>


<!-- ===================== CART OFFCANVAS PANEL ===================== -->
<div
    class="offcanvas offcanvas-end"
    tabindex="-1"
    id="cartOffcanvas"
    aria-labelledby="cartOffcanvasLabel">
 
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="cartOffcanvasLabel">
            <i class="ti ti-shopping-cart me-1" style="background-color: transparent;"></i>
            Your Cart
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
 
    <div class="offcanvas-body d-flex flex-column p-0">
 
        <!-- Cart items list -->
        <div id="cartItemsList" class="flex-grow-1 overflow-auto p-3">
            <!-- JS injects cart item rows here -->
            <p id="emptyCartMsg" class="text-muted text-center mt-5">
                <i class="ti ti-shopping-cart-off" style="background-color: transparent; font-size: 32px;"></i><br>
                Your cart is empty
            </p>
        </div>
 
        <!-- Cart summary / checkout -->
        <div class="border-top p-3">
            <div class="d-flex justify-content-between mb-2">
                <span class="text-muted">Subtotal</span>
                <strong id="cartSubtotal">R 0</strong>
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-primary" id="checkoutBtn">
                    Proceed to Checkout
                </button>
                <button class="btn btn-outline-secondary btn-sm" id="clearCartBtn">
                    Clear Cart
                </button>
            </div>
        </div>
 
    </div>
</div>

<!-- ===================== QUICK VIEW MODAL (bigger info card) ===================== -->
<div class="modal fade" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content">

            <div class="modal-header border-0 pb-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row g-0">

                    <!-- Image side -->
                    <div class="col-md-5 qv-image-side">
                        <div class="qv-main-image-wrap">
                            <img id="qvImage" class="qv-main" src="{{ asset('assets/img/ecommerce-images/laptop.png') }}" alt="">
                        </div>
                        <div class="qv-thumb-strip" id="qvThumbStrip">
                            <!-- JS injects thumbnail <img> tags here -->
                        </div>
                    </div>

                    <!-- Info side -->
                    <div class="col-md-7 qv-info-side">

                        <span id="qvStock" class="badge bg-label-success mb-2">In Stock</span>

                        <h4 id="qvName" class="mb-2">Product name</h4>

                        <div class="mb-2">
                            <i class="ti ti-star" style="background-color: transparent; color: yellow; font-size: 15px;"></i>
                            <i class="ti ti-star" style="background-color: transparent; color: yellow; font-size: 15px;"></i>
                            <i class="ti ti-star" style="background-color: transparent; color: yellow; font-size: 15px;"></i>
                            <i class="ti ti-star" style="background-color: transparent; color: yellow; font-size: 15px;"></i>
                            <i class="ti ti-star" style="background-color: transparent; color: yellow; font-size: 15px;"></i>
                            <small class="text-muted" id="qvRating">5.0</small>
                        </div>

                        <h3 class="text-primary mb-3" id="qvPrice">R 0</h3>

                        <p class="text-muted" id="qvDescription">
                            Product description goes here.
                        </p>

                        <hr>

                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
                            <span class="fw-semibold">Quantity</span>
                            <div class="qv-qty-control">
                                <button type="button" id="qvDecreaseBtn">-</button>
                                <span id="qvQty">1</span>
                                <button type="button" id="qvIncreaseBtn">+</button>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" id="qvAddToCartBtn">
                                <i class="ti ti-shopping-cart me-1" style="background-color: transparent;"></i>
                                Add to Cart
                            </button>
                            <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Continue Shopping
                            </button>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('page-script')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const CART_KEY = 'tt_unik_cart';
    let currentQvProduct = null;
    let currentQvQty = 1;

    // ---------- Storage helpers ----------
    function getCart() {
        return JSON.parse(localStorage.getItem(CART_KEY)) || [];
    }

    function saveCart(cart) {
        localStorage.setItem(CART_KEY, JSON.stringify(cart));
    }

    // ---------- Populate quick view modal on open ----------
    document.querySelectorAll('.quick-view-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            currentQvProduct = {
                id: this.dataset.id,
                name: this.dataset.name,
                price: parseFloat(this.dataset.price),
                image: this.dataset.image,
                description: this.dataset.description,
                rating: this.dataset.rating,
                stock: this.dataset.stock,
                gallery: (this.dataset.gallery || this.dataset.image).split('|')
            };
            currentQvQty = 1;

            document.getElementById('qvImage').src = currentQvProduct.image;
            document.getElementById('qvImage').alt = currentQvProduct.name;
            document.getElementById('qvName').textContent = currentQvProduct.name;
            document.getElementById('qvRating').textContent = currentQvProduct.rating;
            document.getElementById('qvPrice').textContent = 'R ' + currentQvProduct.price.toLocaleString();
            document.getElementById('qvDescription').textContent = currentQvProduct.description;
            document.getElementById('qvStock').textContent = currentQvProduct.stock;
            document.getElementById('qvQty').textContent = currentQvQty;

            renderThumbStrip(currentQvProduct.gallery, currentQvProduct.name);
        });
    });

    // ---------- Build thumbnail strip and wire click-to-swap ----------
    function renderThumbStrip(images, name) {
        const strip = document.getElementById('qvThumbStrip');
        strip.innerHTML = '';

        images.forEach(function (src, index) {
            const thumb = document.createElement('img');
            thumb.src = src;
            thumb.alt = name + ' thumbnail ' + (index + 1);
            thumb.className = 'qv-thumb' + (index === 0 ? ' active' : '');

            thumb.addEventListener('click', function () {
                document.getElementById('qvImage').src = src;
                strip.querySelectorAll('.qv-thumb').forEach(t => t.classList.remove('active'));
                thumb.classList.add('active');
            });

            strip.appendChild(thumb);
        });
    }

    // ---------- Quantity controls inside modal ----------
    document.getElementById('qvIncreaseBtn').addEventListener('click', function () {
        currentQvQty += 1;
        document.getElementById('qvQty').textContent = currentQvQty;
    });

    document.getElementById('qvDecreaseBtn').addEventListener('click', function () {
        if (currentQvQty > 1) {
            currentQvQty -= 1;
            document.getElementById('qvQty').textContent = currentQvQty;
        }
    });

    // ---------- Confirm add to cart from inside modal ----------
    document.getElementById('qvAddToCartBtn').addEventListener('click', function () {
        if (!currentQvProduct) return;

        let cart = getCart();
        const existing = cart.find(item => item.id === currentQvProduct.id);

        if (existing) {
            existing.qty += currentQvQty;
        } else {
            cart.push({
                id: currentQvProduct.id,
                name: currentQvProduct.name,
                price: currentQvProduct.price,
                image: currentQvProduct.image,
                qty: currentQvQty
            });
        }

        saveCart(cart);
        renderCart();

        // close modal after adding
        const modalEl = document.getElementById('quickViewModal');
        const modalInstance = bootstrap.Modal.getInstance(modalEl);
        if (modalInstance) modalInstance.hide();

        // quick feedback on the floating cart button
        const cartBtn = document.getElementById('floatingCartBtn');
        cartBtn.classList.add('shadow');
        setTimeout(() => cartBtn.classList.remove('shadow'), 400);
    });

    // ---------- Render cart panel ----------
    function renderCart() {
        const cart = getCart();
        const list = document.getElementById('cartItemsList');
        const emptyMsg = document.getElementById('emptyCartMsg');
        const badge = document.getElementById('cartCountBadge');
        const subtotalEl = document.getElementById('cartSubtotal');

        list.innerHTML = '';

        if (cart.length === 0) {
            list.appendChild(emptyMsg);
            badge.textContent = '0';
            subtotalEl.textContent = 'R 0';
            return;
        }

        let totalCount = 0;
        let subtotal = 0;

        cart.forEach(function (item) {
            totalCount += item.qty;
            subtotal += item.qty * item.price;

            const row = document.createElement('div');
            row.className = 'cart-item-row';
            row.innerHTML = `
                <img src="${item.image}" alt="${item.name}">
                <div class="cart-item-info">
                    <h6>${item.name}</h6>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="cart-qty-control">
                            <button type="button" data-action="dec" data-id="${item.id}">-</button>
                            <span>${item.qty}</span>
                            <button type="button" data-action="inc" data-id="${item.id}">+</button>
                        </div>
                        <strong>R${(item.price * item.qty).toLocaleString()}</strong>
                    </div>
                    <button type="button" class="cart-remove-btn" data-action="remove" data-id="${item.id}">
                        Remove
                    </button>
                </div>
            `;
            list.appendChild(row);
        });

        badge.textContent = totalCount;
        subtotalEl.textContent = 'R ' + subtotal.toLocaleString();
    }

    // ---------- Qty +/- and remove inside offcanvas cart ----------
    document.getElementById('cartItemsList').addEventListener('click', function (e) {
        const btn = e.target.closest('button[data-action]');
        if (!btn) return;

        const action = btn.dataset.action;
        const id = btn.dataset.id;
        let cart = getCart();
        const item = cart.find(i => i.id === id);
        if (!item) return;

        if (action === 'inc') {
            item.qty += 1;
        } else if (action === 'dec') {
            item.qty -= 1;
            if (item.qty <= 0) {
                cart = cart.filter(i => i.id !== id);
            }
        } else if (action === 'remove') {
            cart = cart.filter(i => i.id !== id);
        }

        saveCart(cart);
        renderCart();
    });

    // ---------- Clear cart ----------
    document.getElementById('clearCartBtn').addEventListener('click', function () {
        saveCart([]);
        renderCart();
    });

    // ---------- Checkout placeholder ----------
    document.getElementById('checkoutBtn').addEventListener('click', function () {
        const cart = getCart();
        if (cart.length === 0) {
            alert('Your cart is empty.');
            return;
        }
        alert('Checkout flow not built yet — this will redirect to /checkout.');
    });

    // ---------- Initial render on page load ----------
    renderCart();

});
</script>

@endsection