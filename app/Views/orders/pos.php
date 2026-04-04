<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Riverside Café | POS System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), 
                        url('https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?q=80&w=2078&auto=format&fit=crop');
            background-size: cover;
            background-attachment: fixed;
            font-family: 'Poppins', sans-serif;
            color: #fff;
            min-height: 100vh;
        }

        /* Glassmorphism Effect */
        .glass-panel {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 20px;
        }

        .product-card {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 15px;
            transition: 0.3s;
            cursor: pointer;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .product-card:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-5px);
        }

        .btn-order {
            background: #6f4e37; /* Coffee Brown */
            color: white;
            border-radius: 10px;
            border: none;
        }

        .btn-order:hover {
            background: #a67b5b;
        }

        .cart-container {
            position: sticky;
            top: 20px;
        }

        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.3); border-radius: 10px; }
    </style>
</head>
<body>

<div class="container-fluid p-4">
    <div class="row">
        <div class="col-12 mb-4 text-center">
            <h1 class="fw-bold" style="text-shadow: 2px 2px 10px rgba(0,0,0,0.5);">☕ Riverside Café POS</h1>
            <p class="badge bg-light text-dark">Midterm System v1.0</p>
        </div>

        <div class="col-md-8">
            <div class="glass-panel h-100">
                <h4 class="mb-4 border-bottom pb-2">Menu Items</h4>
                <div class="row">
                    <?php if(!empty($products)): foreach($products as $p): ?>
                    <div class="col-md-4 col-lg-3 mb-3">
                        <div class="product-card p-3 text-center" onclick="addToCart('<?= $p['name'] ?>', <?= $p['price'] ?>)">
                            <h6 class="mb-1"><?= $p['name'] ?></h6>
                            <small class="d-block mb-2 text-warning">₱<?= number_format($p['price'], 2) ?></small>
                            <button class="btn btn-sm btn-order px-3">Add Order</button>
                        </div>
                    </div>
                    <?php endforeach; else: ?>
                        <p class="text-center">No products found. Add some in the database!</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="glass-panel cart-container shadow">
                <h4 class="mb-4 border-bottom pb-2">Order Summary</h4>
                <div id="cart-items" style="max-height: 300px; overflow-y: auto;">
                    <p class="text-center text-light opacity-50">Empty order...</p>
                </div>
                
                <hr class="mt-4">
                <div class="d-flex justify-content-between">
                    <h5>Grand Total:</h5>
                    <h5 class="text-warning">₱<span id="total-display">0.00</span></h5>
                </div>

                <div class="mt-3">
                    <label class="small opacity-75">Cash Amount:</label>
                    <input type="number" id="cash-input" class="form-control bg-transparent text-white border-secondary mb-2" placeholder="0.00">
                    <div class="d-flex justify-content-between mb-3">
                        <span>Change:</span>
                        <span id="change-display">₱0.00</span>
                    </div>
                    <button class="btn btn-success w-100 py-2 fw-bold" onclick="processPayment()">CONFIRM & SERVE</button>
                    <button class="btn btn-outline-danger btn-sm w-100 mt-2" onclick="location.reload()">Clear All</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let cart = [];
    let grandTotal = 0;

    function addToCart(name, price) {
        cart.push({ name, price });
        updateUI();
    }

    function updateUI() {
        const cartDiv = document.getElementById('cart-items');
        cartDiv.innerHTML = "";
        grandTotal = 0;

        cart.forEach((item, index) => {
            grandTotal += item.price;
            cartDiv.innerHTML += `
                <div class="d-flex justify-content-between align-items-center mb-2 bg-white bg-opacity-10 p-2 rounded">
                    <span>${item.name}</span>
                    <span class="fw-bold">₱${item.price.toFixed(2)}</span>
                </div>
            `;
        });

        document.getElementById('total-display').innerText = grandTotal.toFixed(2);
        calculateChange();
    }

    function calculateChange() {
        const cash = parseFloat(document.getElementById('cash-input').value) || 0;
        const change = cash - grandTotal;
        document.getElementById('change-display').innerText = "₱" + (change > 0 ? change.toFixed(2) : "0.00");
    }

    document.getElementById('cash-input').addEventListener('input', calculateChange);

    function processPayment() {
        const cash = parseFloat(document.getElementById('cash-input').value) || 0;
        if(cart.length === 0) return alert("Please select a drink first!");
        if(cash < grandTotal) return alert("Inadequate cash payment!");

        alert("☕ Riverside Café: Payment Successful!\nOrder is being prepared.");
        location.reload();
    }
</script>

</body>
</html>