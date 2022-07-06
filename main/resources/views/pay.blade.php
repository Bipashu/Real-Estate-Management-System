@extends('layouts.userLayout')

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
            <form action="/logout" method="POST" class="rounded bg-white shadow p-5">
               
            @csrf
                <h3 class="text-dark fw-bolder fs-4 mb-2 text-muted">You are now a Premium User.</h3>
                <div class="fw-normal text-muted mb-4" >
                  To Access Your Premium Account Login Again
                </div>
                
                
                <button type="submit"class="btn submit-btn w-100 my-4 text-white" style="background-color:#a60c20;">Logout</button>
               
                
            </form>
        </div>
    </div>

@stop