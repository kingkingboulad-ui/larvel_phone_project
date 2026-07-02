<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            /* الألوان المخصصة التي أرسلتها */
            --primary-color: #00b35e;       
            --primary-hover: #00ff87;       
            --secondary-color: #475569;     
            --bg-color: #f8fafc;            
            --card-bg: #ffffff;             
            --text-color: #0f172a;          
            --text-muted: #64748b;          
            --border-color: #e2e8f0;        
            
            /* القياسات والتأثيرات */
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --transition: all 0.3s ease;
        }

        body {
            background-color: #0f172a;
            color: var(--text-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
            padding: 15px;
        }

        .login-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            padding: 2.5rem 2rem;
            transition: var(--transition);
        }

        .brand-logo {
            color: var(--primary-color);
            font-size: 2rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 0.5rem;
        }

        .brand-logo i {
            margin-right: 8px;
        }

        .login-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-color);
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-label {
            color: var(--text-color);
            font-weight: 500;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .custom-input {
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 0.75rem 1rem;
            color: var(--text-color);
            background-color: #ffffff;
            transition: var(--transition);
        }

        .custom-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(0, 179, 94, 0.15);
            outline: none;
        }

        /* حقل كلمة المرور مع زر الإظهار */
        .password-wrapper {
            position: relative;
        }

        .password-wrapper .toggle-password {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--text-muted);
            transition: var(--transition);
        }

        .password-wrapper .toggle-password:hover {
            color: var(--primary-color);
        }

        /* تخصيص الـ Checkbox */
        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .form-check-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(0, 179, 94, 0.15);
        }

        .form-check-label, .forgot-link {
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .forgot-link {
            text-decoration: none;
            transition: var(--transition);
        }

        .forgot-link:hover {
            color: var(--primary-color);
        }

        /* الزر الأساسي الأخضر */
        .btn-login {
            background-color: var(--primary-color);
            color: #ffffff;
            border: none;
            border-radius: var(--radius-md);
            padding: 0.75rem;
            font-weight: 600;
            width: 100%;
            transition: var(--transition);
            margin-top: 1rem;
        }

        .btn-login:hover {
            background-color: var(--primary-hover);
            color: #0f172a; /* لون داكن يتناسب مع الأخضر المضيء عند التمرير */
            box-shadow: 0 4px 12px rgba(0, 255, 135, 0.3);
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-card">
        <div class="brand-logo">
            <i class="fas fa-cubes"></i><span>Brand</span>
        </div>
        <p class="login-title">Welcome Back</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf
        
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
        
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control custom-input @error('email') is-invalid @enderror"
                    value="{{ old('email') }}"
                    placeholder="name@example.com"
                    required
                    autofocus
                >
        
                @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
        
                <div class="password-wrapper">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control custom-input @error('password') is-invalid @enderror"
                        placeholder="••••••••"
                        required
                    >
        
                    <i class="fas fa-eye toggle-password" id="eyeIcon"></i>
                </div>
        
                @error('password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        
            <div class="d-flex justify-content-between align-items-center mb-4">
        
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="remember_me"
                        name="remember">
        
                    <label class="form-check-label" for="remember_me">
                        Remember me
                    </label>
                </div>
        
                @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">
                        Forgot password?
                    </a>
                @endif
        
            </div>
        
            <button type="submit" class="btn btn-login">
                Sign In <i class="fas fa-sign-in-alt ms-2"></i>
            </button>
        
        </form>
    </div>
</div>

<script>
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    eyeIcon.addEventListener('click', function () {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    });
</script>

</body>
</html>