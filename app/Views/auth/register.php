<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sari-Smart | Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(rgba(15, 23, 42, 0.7), rgba(15, 23, 42, 0.7)), 
                        url('https://images.unsplash.com/photo-1605371924599-2d036cda1ae0?q=80&w=2070&auto=format&fit=crop'); 
            background-size: cover; background-position: center; height: 100vh;
            display: flex; align-items: center; justify-content: center; margin: 0;
        }
        .glass-register {
            background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 30px;
            padding: 40px; width: 100%; max-width: 450px; color: white; text-align: center;
        }
        .sidebar-brand { font-weight: 800; font-size: 1.8rem; background: linear-gradient(to right, #60a5fa, #a855f7); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .form-control, .form-select { background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); color: white; border-radius: 12px; padding: 10px; }
        option { background: #1e293b; color: white; }
        .btn-register { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border: none; width: 100%; padding: 12px; border-radius: 12px; font-weight: 700; color: white; margin-top: 20px; text-decoration: none; display: block; }
    </style>
</head>
<body>
    <div class="glass-register">
        <div class="sidebar-brand">CREATE ACCOUNT</div>
        <p class="small opacity-75 mb-4">Register your store staff</p>
        
        <div class="mb-3 text-start">
            <label class="small fw-bold opacity-75">Full Name</label>
            <input type="text" class="form-control" placeholder="Juan Dela Cruz">
        </div>
        <div class="mb-3 text-start">
            <label class="small fw-bold opacity-75">Username</label>
            <input type="text" class="form-control" placeholder="admin123">
        </div>
        <div class="mb-3 text-start">
            <label class="small fw-bold opacity-75">Account Role</label>
            <select class="form-select">
                <option>Admin</option>
                <option>Staff</option>
            </select>
        </div>
        
        <a href="<?= base_url('login') ?>" class="btn-register">CREATE ACCOUNT</a>
        
        <div class="mt-3">
            <a href="<?= base_url('login') ?>" class="text-white-50 text-decoration-none small">Already have account? <b>Login</b></a>
        </div>
    </div>
</body>
</html>