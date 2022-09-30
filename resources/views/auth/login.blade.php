@extends('layouts.auth_header')

@section('content')

<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary" style="margin-top: 200px;">
    <div class="card-header text-center">
      <a href="{{ url('/')}}" class="h2"><b>Gugsabas</b> Engineering</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      @if ($errors->any())
                <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-ban"></i> <strong>Whoops!</strong><br><br>
                  There were some problems with your input.</h5>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </div>
          @endif

      <form method="POST" action="{{ route('login') }}">
         @csrf
        <div class="input-group mb-3 form-group">
          <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email" :value="old('email')" required autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3 form-group">
          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" required autocomplete="current-password" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

@endsection
