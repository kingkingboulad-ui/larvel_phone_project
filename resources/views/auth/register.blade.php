<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Dashboard</title>
    <link href="{{asset('asset/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            /* الألوان المخصصة المتناسقة */
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
            background-color:#0f172a;
            color: var(--text-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-container {
            width: 100%;
            max-width: 480px;
            padding: 20px;
        }

        .register-card {
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

        .register-title {
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

        /* حقول كلمة المرور التفاعلية */
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

        /* تخصيص الـ Checkbox لسياسة الخصوصية */
        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .form-check-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(0, 179, 94, 0.15);
        }

        .form-check-label {
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .policy-link, .login-link {
            color: var(--primary-color);
            text-decoration: none;
            transition: var(--transition);
            font-weight: 500;
        }

        .policy-link:hover, .login-link:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }

        /* زر التسجيل الأساسي الأخضر */
        .btn-register {
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

        .btn-register:hover {
            background-color: var(--primary-hover);
            color: #0f172a; 
            box-shadow: 0 4px 12px rgba(0, 255, 135, 0.3);
        }

        .footer-text {
            font-size: 0.9rem;
            color: var(--text-muted);
            text-align: center;
            margin-top: 1.5rem;
        }
    </style>
</head>
<body>

<div class="register-container">
    <div class="register-card">
        <div class="brand-logo">
            <i class="fas fa-cubes"></i><span>Brand</span>
        </div>
        <p class="register-title">Create New Account</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf
        
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
        
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    class="form-control custom-input @error('name') is-invalid @enderror"
                    placeholder="John Doe"
                    required
                    autofocus>
        
                @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
        
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="form-control custom-input @error('email') is-invalid @enderror"
                    placeholder="name@example.com"
                    required>
        
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
                        required>
        
                    <i class="fas fa-eye toggle-password" id="eyeIcon1"></i>
                </div>
        
                @error('password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">
                    Confirm Password
                </label>
        
                <div class="password-wrapper">
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="form-control custom-input"
                        placeholder="••••••••"
                        required>
        
                    <i class="fas fa-eye toggle-password" id="eyeIcon2"></i>
                </div>
            </div>
        
       
                <div class="mb-4">
                    <div class="form-check">
                        <input class="form-check-input"
                               type="checkbox"
                               name="terms"
                               id="terms"
                               required>
                               <label class="form-check-label" for="terms">
                                I agree to the Terms of Service & Privacy Policy
                            </label>
                    </div>
                </div>
        
        
            <button type="submit" class="btn btn-register">
                Register Account
                <i class="fas fa-user-plus ms-2"></i>
            </button>
        
        </form>

        <p class="footer-text">
            Already have an account? <a href="{{ route('login') }}" class="login-link">Sign In</a>
        </p>
    </div>
</div>

<script>
    function setupPasswordToggle(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

        icon.addEventListener('click', function () {
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    }


    setupPasswordToggle('password', 'eyeIcon1');
    setupPasswordToggle('password_confirmation', 'eyeIcon2');
</script>

</body>
</html>