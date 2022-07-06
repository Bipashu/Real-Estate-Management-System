@extends('layouts.homeLayout1')

@section('content')


    <div class="container">
        <div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 text-center">
            <div class="logo">
              <img src="{{ URL('images/logo.png') }}" alt="logo" class="img-fluid">
            </div>
            @if(session('status'))
               <p class="text-white p-3 w-full rounded-lg text-center" style="background-color:#0cad34;">{{session('status')}}</p>
               @elseif(session('email'))
               <p class=" text-white p-3 w-full rounded-lg text-center" style="background-color:#d4080f">{{session('email')}}</p>
               @endif

            <form action="{{ route('password.email')}}" method="POST" class="rounded bg-white shadow p-5">
            
            @csrf
            
                <h3 class="text-dark fw-bolder fs-4 mb-2 text-muted">Reset your password</h3>
                <div class="fw-normal text-muted mb-4" >
                    Enter your email address </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control bg-light border border-white @error('email') is-invalid @enderror" id="floatingInput" name="email" placeholder="name@example.com">
                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    <label for="floatingInput" class="text-muted">Email address</label>
                </div>
                
                <button type="submit"class="btn submit-btn w-100 my-4 text-white" style="background-color:#85DCBA;">Reset</button>
                
            </form>
        </div>
    </div>

@stop
