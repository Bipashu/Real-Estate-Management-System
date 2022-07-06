@extends('layouts.adminLayout')

@section('content')

<div class="container">
    <div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 text-center">
    <div class="logo">
              <img src="{{ URL('images/agents.png') }}" alt="agents" class="img-fluid">
            </div>
            <form action="/edited" method="POST" class="rounded bg-white shadow p-5">
                @if(Session::has('fail'))
                <div class="alert alert-fail">{{Session::get('fail')}}</div>
                @endif
            @csrf
                <h3 class="text-dark fw-bolder fs-4 mb-2 text-muted">Edit agent</h3>
                <input type="hidden" class="form-control bg-light border border-white" id="floatingInput" name="id" value="{{ $id }}">
                
                <div class="form-floating mb-3">
                
                    <input type="email" class="form-control bg-light border border-white" value="{{$agent->email}}" id="floatingInput" name="email" placeholder="name@example.com">
                    @error('email')
                    <div class="alert-danger">{{$message}}</div>
                    @enderror
                    <label for="floatingInput" class="text-muted">Email address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control bg-light border border-white" value="{{$agent->fullname}}" id="floatingPassword" name="fullname" placeholder="fullname">
                    @error('fullname')
                    <div class="alert-danger ">{{$message}}</div>
                    @enderror
                    <label for="floatingPassword" class="text-muted">Full Name</label>
                </div>
    
            
                <button type="submit"class="btn submit-btn w-100 my-4" style="background-color:#85DCBA;">Edit</button>
                <a href="{{ route('agent-models') }}" class="btn btn-light login-with w-100 mb-3 text-muted text-decoration-none">
                     Back to List
                </a>
            </form>

    </div>
</div>
    
@stop
