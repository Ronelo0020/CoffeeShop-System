<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Manage Staff | Riverside Café</title>
    
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
            display: flex; 
            min-height: 100vh; 
            margin: 0; 
        }

        /* Sidebar Styling */
        .sidebar { 
            width: 260px; 
            background: var(--sidebar-bg); 
            padding: 30px 20px; 
            color: white; 
            position: fixed; 
            height: 100vh; 
            z-index: 1000;
        }

        .nav-link { 
            color: rgba(255,255,255,0.7); 
            padding: 12px 15px; 
            border-radius: 10px; 
            text-decoration: none; 
            display: flex; 
            align-items: center; 
            font-size: 0.9rem; 
            transition: 0.3s; 
            margin-bottom: 5px;
        }

        .nav-link:hover, .nav-link.active { 
            background: rgba(255,255,255,0.1); 
            color: var(--riverside-red); 
        }

        /* Content Area */
        .main-content { 
            flex: 1; 
            margin-left: 260px; 
            padding: 40px; 
        }

        .table-container { 
            background: #fff; 
            border-radius: 15px; 
            border: 1px solid #dee2e6; 
            padding: 30px; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.03); 
        }

        .badge-role {
            font-size: 0.7rem;
            padding: 5px 12px;
            border-radius: 50px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Action Buttons */
        .btn-action {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: 0.2s;
            text-decoration: none;
        }

        .btn-edit { color: #0d6efd; background: #e7f0ff; }
        .btn-edit:hover { background: #0d6efd; color: white; }

        .btn-delete { color: #dc3545; background: #ffeef0; margin-left: 5px; border: none; }
        .btn-delete:hover { background: #dc3545; color: white; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="mb-5 text-center">
        <h4 class="fw-bold"><span style="color:var(--riverside-red)">Riverside</span> Café</h4>
        <small class="text-muted">Staff Administration</small>
    </div>
    <nav>
        <a href="<?= base_url('dashboard') ?>" class="nav-link">
            <i class="fas fa-chart-pie me-3"></i> Overview
        </a>
        <a href="<?= base_url('auth/manage') ?>" class="nav-link active">
            <i class="fas fa-users-cog me-3"></i> Manage Staff
        </a>
    </nav>
    <div class="mt-auto pt-3 border-top border-secondary">
        <a href="<?= base_url('auth/logout') ?>" class="nav-link text-danger">
            <i class="fas fa-sign-out-alt me-3"></i> Logout
        </a>
    </div>
</div>

<div class="main-content">
    <div class="d-md-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">Staff Management</h2>
            <p class="text-muted small">Update or remove members from your team.</p>
        </div>
        <a href="<?= base_url('auth/register') ?>" class="btn btn-danger px-4 shadow-sm" style="border-radius: 10px;">
            <i class="fas fa-user-plus me-2"></i> Add New Staff
        </a>
    </div>

    <?php if(session()->getFlashdata('msg')): ?>
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('msg') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="table-container">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr class="text-secondary small">
                        <th class="py-3 px-3">FULL NAME</th>
                        <th class="py-3">EMAIL ADDRESS</th>
                        <th class="py-3">ROLE</th>
                        <th class="py-3 text-center">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($staff_members)): foreach($staff_members as $staff): ?>
                    <tr>
                        <td class="px-3">
                            <span class="fw-bold text-dark d-block"><?= $staff['name'] ?></span>
                        </td>
                        <td class="text-muted small"><?= $staff['email'] ?></td>
                        <td>
                            <span class="badge bg-dark badge-role">
                                <?= strtoupper($staff['role']) ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="<?= base_url('auth/edit/'.$staff['id']) ?>" class="btn-action btn-edit" title="Edit Staff">
                                <i class="fas fa-edit"></i>
                            </a>
                            
                            <a href="<?= base_url('auth/delete/'.$staff['id']) ?>" 
                               class="btn-action btn-delete" 
                               title="Delete Staff"
                               onclick="return confirm('Sigurado ka nga i-remove ini nga staff member? Indi na ini ma-undo.')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">
                            <i class="fas fa-users-slash d-block mb-2 fs-3"></i>
                            No staff members found.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>