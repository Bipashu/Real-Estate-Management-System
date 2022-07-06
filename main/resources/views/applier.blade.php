@extends('layouts.premiumUserLayout')

@section('content')


<div class="container">
<div class="table-responsive col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-7 offset-xl-3.5 text-center" id="no-more-tables">
    <table class="table bg-white rounded bg-white shadow p-5 ps-2">
   
        <thead class="text-white" style="background-color:#C38D9E;">
            <tr>
                <th>Email</th>
                <th>Name</th>
                <th></th>
                
            </tr>
        </thead>
        <tbody>
            
            <tr>
                <td data-title="Full Name" class="text-muted">{{$user->email}}</td>
                <td data-title="Email Address" class="text-muted" >{{$user->name}}</td>
                <td><a href={{"/acceptRent/".$id}}><button class="btn btn-submit btn-warning" > Accept</button></a></td>
               
            </tr>
            

        </tbody>
    </table>
</div>
</div>

@stop