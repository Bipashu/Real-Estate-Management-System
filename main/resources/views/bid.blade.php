@extends('layouts.userLayout')

@section('content')


<div class="container">
<div class="table-responsive col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-7 offset-xl-3.5 text-center" id="no-more-tables">
    <table class="table bg-white rounded bg-white shadow p-5 ps-2">
   
        <thead class="text-white" style="background-color:#C38D9E;">
            <tr>
                <th>Bid amount</th>
                <th>Email Address</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach($bids as $bid)
            <tr>
                <td data-title="Full Name" class="text-muted">{{$bid->bid_amount}}</td>
                <td data-title="Email Address" class="text-muted" >{{Auth::user()->email}}</td>
               
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
</div>

@stop