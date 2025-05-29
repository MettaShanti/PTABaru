<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login - Persediaan Produk CV Jaya Abadi</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" />
  <link id="pagestyle" href="{{ asset('css/soft-ui-dashboard.css?v=1.0.7') }}" rel="stylesheet" />
  <style>
      body {
        background: url('{{ asset('img/bg.jpg') }}') no-repeat center center fixed;
        background-size: cover;
        min-height: 100vh;
      }
      .card {
        border-radius: 1rem;
        backdrop-filter: blur(10px);
        background-color: rgba(255, 255, 255, 0.85);
      }
</style>

</head>
<body>
  <div class="container d-flex align-items-center justify-content-center" style="min-height:100vh;">
    <div class="row w-100 justify-content-center">
      <div class="col-md-5">
        <div class="card shadow-lg">
          <div class="card-body p-4">
            <div class="text-center mb-4">
              <!-- <img src="{{ asset('img/apple-icon.png') }}" width="60" alt="Logo"> -->
              <h4 class="mt-2 mb-0 font-weight-bold">Login</h4>
              <small class="text-muted">Persediaan Produk CV Jaya Abadi</small>
            </div>
            @if(session('error'))
              <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-group input-group-outline">
                  <span class="input-group-text"><i class="fa fa-user"></i></span>
                  <input type="email" name="email" id="email" class="form-control" required autofocus placeholder="Masukkan email">
                </div>
                @error('email')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group input-group-outline">
                  <span class="input-group-text"><i class="fa fa-lock"></i></span>
                  <input type="password" name="password" id="password" class="form-control" required placeholder="Masukkan password">
                </div>
                @error('password')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <button type="submit" class="btn btn-primary w-100" style="border-radius: 1rem;">Login</button>
            </form>
            <div class="mt-3 text-center">
              <!-- <a href="{{ route('password.request') }}" class="text-secondary">Lupa password?</a> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>