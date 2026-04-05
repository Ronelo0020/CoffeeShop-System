<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sari-Smart | Welcome</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #0f172a;
            /* Dynamic Background similar to Dashboard */
            background-image: 
                radial-gradient(at 0% 0%, hsla(253,16%,7%,1) 0, transparent 50%), 
                radial-gradient(at 50% 0%, hsla(225,39%,30%,1) 0, transparent 50%), 
                radial-gradient(at 100% 0%, hsla(339,49%,30%,1) 0, transparent 50%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .auth-container {
            width: 100%;
            max-width: 450px;
            padding: 20px;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 30px;
            padding: 40px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            color: white;
            text-align: center;
        }

        .brand-logo {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(to right, #60a5fa, #a855f7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            padding: 12px 20px;
            color: white;
            transition: 0.3s;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: #60a5fa;
            color: white;
            box-shadow: 0 0 15px rgba(96, 165, 250, 0.3);
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .btn-auth {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 700;
            width: 100%;
            margin-top: 20px;
            transition: 0.3s;
            color: white;
        }

        .btn-auth:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.4);
        }

        .switch-text {
            margin-top: 25px;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.6);
        }

        .switch-link {
            color: #60a5fa;
            text-decoration: none;
            font-weight: 600;
        }

        .switch-link:hover {
            text-decoration: underline;
        }

        /* Simple animation for switching */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="auth-container">
    <div class="glass-card fade-in" id="authBox">
        <div class="brand-logo">SARI-SMART</div>
        <p class="text-white-50 mb-4 small">Inventory & POS System</p>

        <div id="loginForm">
            <h4 class="fw-bold mb-4">Login to Account</h4>
            <form action="<?= base_url('auth/login_process') ?>" method="POST">
                <div class="mb-3 text-start">
                    <label class="small mb-1 opacity-75">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Enter your username" required>
                </div>
                <div class="mb-3 text-start">
                    <label class="small mb-1 opacity-75">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
                <div class="text-end mb-3">
                    <a href="#" class="tiny switch-link" style="font-size: 0.75rem;">Forgot Password?</a>
                </div>
                <button type="submit" class="btn-auth">Login Now</button>
            </form>
            <p class="switch-text">Don't have an account? <a href="javascript:void(0)" class="switch-link" onclick="toggleAuth()">Register here</a></p>
        </div>

        <div id="registerForm" style="display: none;">
            <h4 class="fw-bold mb-4">Create Account</h4>
            <form action="<?= base_url('auth/register_process') ?>" method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3 text-start">
                        <label class="small mb-1 opacity-75">Full Name</label>
                        <input type="text" name="fullname" class="form-control" placeholder="Juan Dela Cruz" required>
                    </div>
                    <div class="col-md-6 mb-3 text-start">
                        <label class="small mb-1 opacity-75">Section</label>
                        <input type="text" name="section" class="form-control" placeholder="BSIT 2A" required>
                    </div>
                </div>
                <div class="mb-3 text-start">
                    <label class="small mb-1 opacity-75">Username</label>
                    <input type="text" name="reg_username" class="form-control" placeholder="Choose username" required>
                </div>
                <div class="mb-3 text-start">
                    <label class="small mb-1 opacity-75">Password</label>
                    <input type="password" name="reg_password" class="form-control" placeholder="Create password" required>
                </div>
                <button type="submit" class="btn-auth">Create Account</button>
            </form>
            <p class="switch-text">Already have an account? <a href="javascript:void(0)" class="switch-link" onclick="toggleAuth()">Login here</a></p>
        </div>
    </div>
</div>

<script>
    function toggleAuth() {
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');
        const authBox = document.getElementById('authBox');

        // Add small animation
        authBox.classList.remove('fade-in');
        void authBox.offsetWidth; // trigger reflow
        authBox.classList.add('fade-in');

        if (loginForm.style.display === 'none') {
            loginForm.style.display = 'block';
            registerForm.style.display = 'none';
        } else {
            loginForm.style.display = 'none';
            registerForm.style.display = 'block';
        }
    }
</script>

</body>
</html>