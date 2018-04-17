<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Login/Logout animation concept</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
  
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans'>

  <link rel="stylesheet" href="{{asset('css/styleLogin.css')}}">

  
</head>

<body>

  <div class="cont">
    <div class="demo">
      <div class="login">
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="login__check"></div>
          <div class="login__form">
            <div class="login__row">
              <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
              </svg>
              <!-- <input type="text"  placeholder="Username"/> -->
              <input id="email" class="login__input name" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

              @if ($errors->has('email'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
              @endif
            </div>
            <div class="login__row">
              <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
              </svg>
              <!-- <input type="password" class="login__input pass" placeholder="Password"/> -->
              <input id="password" class="login__input pass" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

              @if ($errors->has('password'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
              @endif
            </div>
            <br>
            <br>
            <div class="form-group row">
              <div class="col-md-6 offset-md-4">
                <div class="checkbox">
                  <label style="font-size: 15px">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                  </label>
                </div>
              </div>
            </div>
            <button type="submit" class="login__submit" style="margin: 10px"> {{ __('Login') }}</button>
            <p class="login__signup"> &nbsp;<a href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}</a></p>
          </div>
        </div>
        

        
      </form>
    </div>
  </div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  

  <script  src="{{asset('js/index.js')}}"></script>




</body>

</html>
