@extends('layouts.adminLayout')

@section('content')


    <div class="container">
        <div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 text-center">
            <div class="logo">
              <img src="{{ URL('images/agents.png') }}" alt="logo" class="img-fluid">
            </div>
            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="/register" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                @endforeach
            </div>
            <form action="" method="POST" class="rounded bg-white shadow p-5">
               
            @csrf
                <h3 class="text-dark fw-bolder fs-4 mb-2 text-muted">Add new agent</h3>
                
                <div class="form-floating mb-3">
                    <input type="text" class="form-control bg-light border border-white @error('name') is-invalid @enderror" id="floatingInput" name="name" placeholder="name">
                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    <label for="floatingName" class="text-muted">Name</label>
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
                <div class="form-floating mb-3">
                    <input type="password" class="form-control bg-light border border-white @error('password') is-invalid @enderror" id="floatingPassword" name="password" placeholder="Password" required autocomplete="new-password">
                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    <label for="floatingPassword" class="text-muted">Password</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control bg-light border border-white " id="floatingPassword" name="password_confirmation" placeholder="Password" required autocomplete="new-password">
                   
                    <label for="floatingPasswordConfirm" class="text-muted">Confirm Password</label>
                </div>
                
                <button type="submit"class="btn submit-btn w-100 my-4 text-white" style="background-color:#85DCBA;">Register</button>
               

                <a href="{{ route('agent-models') }}" class="btn btn-light login-with w-100 mb-3 text-muted text-decoration-none">
                     Back to List
                </a>
            </form>
        </div>
    </div>

@stop
