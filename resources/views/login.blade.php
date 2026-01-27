<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <link rel="stylesheet" href="{{ asset('mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  <img src="{{ asset('assets/images/logo.svg') }}">
                </div>
                <h4>School Management System</h4>
                <h6 class="font-weight-light">Sign in to your account</h6>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form class="pt-3" method="POST" action="{{ route('login.submit') }}">
                  @csrf
                  <div class="form-group">
                    <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="mt-3 d-grid gap-2">
                    <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input" name="remember"> Keep me signed in </label>
                    </div>
                    <a href="#" class="auth-link text-primary">Forgot password?</a>
                  </div>
                  <div class="text-center mt-4 font-weight-light"> Don't have an account? <a href="{{ route('register') }}" class="text-primary">Create</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="{{ asset('js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/misc.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/todolist.js') }}"></script>
    <script src="{{ asset('js/jquery.cookie.js') }}"></script>
  </body>
</html>
