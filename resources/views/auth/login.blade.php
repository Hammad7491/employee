<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login | Silva Dashboard</title>
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" sizes="16x16" />
    <link rel="stylesheet" href="{{ asset('assets/css/lib/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #f0f4f8, #d9e2ec);
        }
        .login-box {
            max-width: 420px;
            padding: 40px 30px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .login-title {
            font-size: 1.8rem;
            font-weight: bold;
            color: #333;
        }
        .login-subtitle {
            font-size: 0.95rem;
            color: #666;
            margin-bottom: 25px;
        }
        .btn-toggle {
            background: none;
            border: none;
            font-size: 1.1rem;
        }
        .top-left-btn {
            position: absolute;
            top: 20px;
            left: 20px;
        }
    </style>
</head>
<body>
    <a href="{{ url('/') }}" class="btn btn-outline-primary btn-sm top-left-btn">← Back to Landing Page</a>

    <section class="d-flex align-items-center justify-content-center min-vh-100">
        <div class="login-box">
            <div class="text-center">
                <h2 class="login-title">Admin Login</h2>
                <p class="login-subtitle">Only authorized admins can sign in.</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger small">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="loginForm" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="emailaddress" class="form-label">Email address</label>
                    <input type="email"
                        name="email"
                        id="emailaddress"
                        class="form-control"
                        placeholder="Enter your email"
                        required
                        value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="position-relative">
                        <input type="password"
                            name="password"
                            id="password"
                            class="form-control"
                            placeholder="Enter your password"
                            required>
                        <button type="button"
                                id="togglePassword"
                                class="btn-toggle position-absolute end-0 top-50 translate-middle-y me-3"
                                data-toggle="#password">
                            <i class="ri-eye-line"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 mt-2">Log In</button>

                <div class="text-center mt-4">
                    <button type="button" class="btn btn-outline-dark btn-sm" onclick="fillLogin('a@a','a')">Login as Admin</button>
                </div>

                <p class="text-center text-muted mt-4 mb-0 small">
                    CNP Generator is available on the system.
                </p>
            </form>
        </div>
    </section>

<script src="{{ asset('assets/js/lib/bootstrap.bundle.min.js') }}"></script>
<script>
    function fillLogin(email, password) {
        document.getElementById('emailaddress').value = email;
        document.getElementById('password').value = password;
        document.getElementById('loginForm').submit();
    }

    document.getElementById('togglePassword').addEventListener('click', function () {
        const input = document.querySelector(this.getAttribute('data-toggle'));
        input.type = input.type === 'password' ? 'text' : 'password';
        this.innerHTML = input.type === 'password'
            ? '<i class="ri-eye-line"></i>'
            : '<i class="ri-eye-off-line"></i>';
    });
</script>
</body>
</html>
