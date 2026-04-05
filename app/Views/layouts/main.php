<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?> | Sari-Smart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --glass-white: rgba(255, 255, 255, 0.7);
            --sidebar-dark: rgba(15, 23, 42, 0.9);
            --primary-gradient: linear-gradient(135deg, #065f46, #fbbf24);
        }
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('<?= base_url('assets/bg.jpg') ?>');
            background-size: cover; background-attachment: fixed; min-height: 100vh;
        }
        .sidebar { width: 280px; height: 100vh; position: fixed; background: var(--sidebar-dark); backdrop-filter: blur(20px); padding: 40px 20px; }
        .nav-link { color: #94a3b8; padding: 15px; border-radius: 12px; display: flex; align-items: center; gap: 12px; text-decoration: none; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { background: var(--primary-gradient); color: white; }
        .main-content { margin-left: 280px; padding: 40px; }
        .glass-card { background: var(--glass-white); backdrop-filter: blur(15px); border-radius: 24px; padding: 25px; border: 1px solid rgba(255,255,255,0.3); }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="text-white fw-bold mb-5 fs-4"><i class="fas fa-store text-warning"></i> SARI-SMART</div>
        <nav>
            <a href="<?= base_url('dashboard') ?>" class="nav-link <?= $title=='Dashboard'?'active':'' ?>"><i class="fas fa-th-large"></i> Dashboard</a>
            <a href="<?= base_url('inventory') ?>" class="nav-link <?= $title=='Inventory'?'active':'' ?>"><i class="fas fa-box"></i> Inventory</a>
            <a href="<?= base_url('pos') ?>" class="nav-link <?= $title=='Sales POS'?'active':'' ?>"><i class="fas fa-shopping-cart"></i> Sales POS</a>
            <a href="<?= base_url('reports') ?>" class="nav-link <?= $title=='Reports'?'active':'' ?>"><i class="fas fa-file-alt"></i> Reports</a>
        </nav>
    </aside>
    <main class="main-content">
        <?= $this->renderSection('content') ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>