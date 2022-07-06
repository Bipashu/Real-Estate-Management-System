@extends('layouts.homeLayout1')

@section('content')


    <div class="container">
        <div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 text-center">
            <div class="logo">
              <img src="{{ URL('images/logo.png') }}" alt="logo" class="img-fluid">
            </div>
            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="/login" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                @endforeach
            </div>
            @if(Session::has('fail'))
  <div class="alert alert-fail">{{Session::get('fail')}}</div>
  @endif
            @if(session('status'))
               <p class="bg-green-500 text-white p-3 w-full rounded-lg text-center">{{session('status')}}</p>
               @elseif(session('email'))
               <p class="bg-red-500 text-white p-3 w-full rounded-lg text-center">{{session('email')}}</p>
               @endif
            <form action="/loggedin" method="POST" class="rounded bg-white shadow p-5">
               
            @csrf
                <h3 class="text-dark fw-bolder fs-4 mb-2 text-muted">Sign in to RPA</h3>
                <div class="fw-normal text-muted mb-4" >
                   Wanna register as user? <a href="/register" class=" fw-bold text-decoration-none" style="color:#E27D60;">Click here</a>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control bg-light border border-white @error('email') is-invalid @enderror" id="floatingInput" name="email" placeholder="name@example.com">
                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    <label for="floatingInput" class="text-muted">Email address</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control bg-light border border-white @error('password') is-invalid @enderror" id="floatingPassword" name="password" placeholder="Password" required autocomplete="current-password">
                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    <label for="floatingPassword" class="text-muted">Password</label>
                </div>
                
                               
                
                <button type="submit"class="btn submit-btn w-100 my-4 text-white" style="background-color:#85DCBA;">Login</button>
               
               
                
            </form>
        </div>
    </div>

@stop
