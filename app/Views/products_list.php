<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riverside | Inventory</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        :root { 
            --riverside-red: #ff4d4d; 
            --sidebar-bg: #212529; 
            --body-bg: #f8f9fa; 
        }
        
        body { 
            background-color: var(--body-bg); 
            font-family: 'Poppins', sans-serif; 
            margin: 0; 
            display: flex; 
            min-height: 100vh; 
        }

        /* Sidebar Styling */
        .sidebar { 
            width: 260px; 
            background: var(--sidebar-bg); 
            padding: 30px 20px; 
            display: flex; 
            flex-direction: column; 
            color: white;
        }

        .nav-link { 
            color: rgba(255,255,255,0.7); 
            padding: 12px 15px; 
            border-radius: 10px; 
            margin-bottom: 5px; 
            transition: 0.3s; 
            text-decoration: none; 
            display: flex; 
            align-items: center;
            font-size: 0.9rem;
        }

        .nav-link:hover, .nav-link.active { 
            background: rgba(255,255,255,0.1); 
            color: var(--riverside-red); 
        }

        .nav-link i { width: 25px; }

        /* Main Content */
        .main-content { flex: 1; padding: 30px; overflow-y: auto; }

        /* Table Container - Clean White */
        .table-container {
            background: #fff;
            border-radius: 15px;
            border: 1px solid #dee2e6;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        }

        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6c757d;
            padding: 15px;
        }

        .product-name { font-weight: 600; color: #212529; }
        .price-tag { color: var(--riverside-red); font-weight: 700; }

        /* Stock Badges */
        .badge-stock { padding: 6px 12px; border-radius: 8px; font-weight: 600; font-size: 0.75rem; }

        /* Action Buttons */
        .btn-action {
            padding: 5px 10px;
            border-radius: 8px;
            transition: 0.3s;
            font-size: 0.85rem;
        }

        .btn-riverside {
            background-color: var(--riverside-red);
            color: white;
            border-radius: 8px;
            font-weight: 600;
            padding: 8px 16px;
            border: none;
            text-decoration: none;
        }

        .btn-riverside:hover { background-color: #e63939; color: white; }

        @media (max-width: 992px) {
            .sidebar { display: none; }
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="mb-5 text-center">
        <h4 class="fw-bold"><span style="color:var(--riverside-red)">Riverside</span> Café</h4>
        <small class="text-muted">Staff Panel</small>
    </div>
    <nav>
        <a href="<?= base_url('dashboard') ?>" class="nav-link"><i class="fas fa-chart-pie"></i> Overview</a>
        <a href="<?= base_url('products') ?>" class="nav-link active"><i class="fas fa-coffee"></i> Menu & Inventory</a>
        <a href="<?= base_url('pos') ?>" class="nav-link"><i class="fas fa-cash-register"></i> Barista POS</a>
        <a href="<?= base_url('sales') ?>" class="nav-link"><i class="fas fa-file-invoice-dollar"></i> Sales Reports</a>
    </nav>
    <div class="mt-auto border-top pt-3">
        <a href="<?= base_url('auth/logout') ?>" class="nav-link text-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>

<div class="main-content">
    <div class="d-md-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">Menu & Inventory</h2>
            <p class="text-muted small">Manage products, pricing, and stock levels.</p>
        </div>
        <a href="<?= base_url('products/add') ?>" class="btn btn-riverside shadow-sm">
            <i class="fas fa-plus me-2"></i> Add New Item
        </a>
    </div>

    <div class="table-container">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Product Details</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($products as $p): ?>
                    <tr>
                        <td>
                            <div class="product-name"><?= $p['product_name'] ?></div>
                            <small class="text-muted">ID: #<?= $p['id'] ?></small>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border"><?= $p['category'] ?></span>
                        </td>
                        <td class="price-tag">₱<?= number_format($p['price'], 2) ?></td>
                        <td>
                            <?php if($p['stock'] <= 5): ?>
                                <span class="badge bg-light text-danger border border-danger badge-stock">
                                    <i class="fas fa-exclamation-triangle me-1"></i> <?= $p['stock'] ?> Low Stock
                                </span>
                            <?php else: ?>
                                <span class="badge bg-light text-success border border-success badge-stock">
                                    <?= $p['stock'] ?> Units
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <a href="<?= base_url('products/edit/'.$p['id']) ?>" class="btn btn-sm btn-outline-primary btn-action me-1">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?= base_url('products/delete/'.$p['id']) ?>" class="btn btn-sm btn-outline-danger btn-action" onclick="return confirm('Sigurado ka nga papason ini?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>