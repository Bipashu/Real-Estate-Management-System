@extends('layouts.adminLayout')

@section('content')

<div class="container">
<div class="table-responsive col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3.5 text-center" id="no-more-tables">
<div class="logo pt-5">
              <img src="{{ URL('images/agents.png') }}" alt="agents" class="img-fluid">
            </div>
    <table class="table bg-white rounded bg-white shadow p-5 ps-2">
    <div class="fw-normal text-muted mb-4" >
                    Wanna add more agents? <a href="{{ route('agent-models.create') }}" class=" fw-bold text-decoration-none" style="color:#E27D60;">Click here.</a>
                </div>
        <thead class="text-white" style="background-color:#C38D9E;">
            <tr>
                <th>Full Name</th>
                <th>Email Address</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($agents as $agent)
            <tr>
                <td data-title="Full Name" class="text-muted">{{$agent->fullname}}</td>
                <td data-title="Email Address" class="text-muted" >{{$agent->email}}</td>
                <td>
                    <a href={{"edit/".$agent->id}} class="text-decoration-none border-end pe-2" style="color:#85DCBA;">Edit</a>
                    <a href={{"delete/".$agent->id}} class="text-decoration-none border-end pe-2" style="color:#85DCBA;">Delete</a>
                     
                     <a href={{"send/".$agent->id}} class="text-decoration-none  pe-2" style="color:#85DCBA;">Send Credentials</a>
                     </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
</div>

    
@stop
