<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit;
}
$cookie_user = isset($_COOKIE['remember_user']) ? $_COOKIE['remember_user'] : '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Mini Digital Library</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            bs-body-font-family: 'Plus Jakarta Sans', sans-serif;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #030712;
            background-image: 
                radial-gradient(at 0% 0%, rgba(79, 70, 229, 0.18) 0px, transparent 50%), 
                radial-gradient(at 100% 100%, rgba(147, 51, 234, 0.15) 0px, transparent 50%),
                radial-gradient(at 50% 50%, rgba(15, 23, 42, 1) 0px, transparent 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 1.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 440px;
            transition: all 0.3s ease;
        }
        .form-control {
            background: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #fff !important;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
        }
        .form-control:focus {
            background: rgba(255, 255, 255, 0.08) !important;
            border-color: #6366f1 !important;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.25) !important;
        }
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }
        .input-group-text {
            background: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: rgba(255, 255, 255, 0.5);
            border-top-left-radius: 0.75rem;
            border-bottom-left-radius: 0.75rem;
        }
        .btn-primary-custom {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            border: none;
            border-radius: 0.75rem;
            padding: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.3px;
            box-shadow: 0 10px 20px -5px rgba(99, 102, 241, 0.4);
            transition: all 0.2s ease;
        }
        .btn-primary-custom:hover {
            background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%);
            transform: translateY(-1px);
            box-shadow: 0 14px 24px -4px rgba(99, 102, 241, 0.5);
        }
        .form-check-input {
            background-color: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.2);
        }
        .form-check-input:checked {
            background-color: #6366f1;
            border-color: #6366f1;
        }
    </style>
</head>
<body>

    <div class="login-card p-4 p-md-5">
        <div class="text-center mb-4">
            <div class="d-inline-flex align-items-center justify-content-center bg-indigo bg-opacity-20 text-indigo rounded-4 p-3 mb-3" style="background: rgba(99, 102, 241, 0.15); width: 64px; height: 64px;">
                <i class="bi bi-book-half fs-2 text-indigo" style="color: #818cf8;"></i>
            </div>
            <h3 class="fw-bold text-white mb-1 tracking-tight">Digital Library</h3>
            <p class="text-secondary small">Autentikasi sistem manajemen perpustakaan</p>
        </div>

        <form action="proses_login.php" method="POST">
            <div class="mb-3">
                <label class="form-label text-light small fw-semibold mb-1">Username</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" name="username" class="form-control border-start-0" value="<?= htmlspecialchars($cookie_user); ?>" placeholder="Masukkan username" required autocomplete="off">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label text-light small fw-semibold mb-1">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control border-start-0" placeholder="••••••••" required>
                </div>
            </div>

            <div class="mb-4 d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label text-secondary small" for="remember">Remember Me</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary-custom w-100 text-white">
                Masuk ke Sistem <i class="bi bi-arrow-right ms-1"></i>
            </button>
        </form>
    </div>

</body>
</html>