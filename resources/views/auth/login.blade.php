<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Peminjaman Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-md-5 col-lg-4">

                <div class="text-center mb-4">
                    <div class="bg-dark text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
                        <i class="bi bi-box-seam-fill fs-3"></i>
                    </div>
                    <h4 class="mt-3 fw-bold">Peminjaman Barang</h4>
                    <p class="text-muted">Silakan login untuk melanjutkan</p>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">

                        @if($errors->any())
                            <div class="alert alert-danger py-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $errors->first() }}
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success py-2">
                                <i class="bi bi-check-circle me-1"></i>{{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="/login">
                            @csrf

                            <div class="mb-3">
                                <label for="username" class="form-label fw-semibold">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" id="username" name="username"
                                           value="{{ old('username') }}" placeholder="Masukkan username" required autofocus>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input type="password" class="form-control" id="password" name="password"
                                           placeholder="Masukkan password" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-dark w-100 fw-semibold py-2">
                                <i class="bi bi-box-arrow-in-right me-1"></i>Login
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card mt-3 border-0 bg-white shadow-sm">
                    <div class="card-body py-2 px-3">
                        <small class="text-muted">
                            <i class="bi bi-info-circle me-1"></i><strong>Demo Akun:</strong><br>
                            Admin: <code>admin</code> / <code>admin123</code><br>
                            Anggota: <code>anggota</code> / <code>anggota123</code>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
