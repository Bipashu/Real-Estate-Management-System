
@extends('layouts.premiumUserLayout')

@section('content')


<div class="container-lg">
<div class="text-start">
        <h5 style="color:#E8A87C;">Sell Property Details</h5>
    </div>
    
    <div class="row justify-content-center  rounded bg-white shadow p-5">
   
        <div class="col-md-6 text-center text-md-start">
            
       
               
              <div class="row">
                  <div class="col-12">
                   <div class="mb-3 d-flex flex-row">
                       <p class="fw-bold">Property Name<p>
                           <p class="mx-3"> : </p>
                       <p>{{$property->name }}</p>
                       
                   </div>

                   <div class="mb-3 d-flex flex-row">
                   <p class="fw-bold">Property Address<p>
                           <p class="mx-3"> : </p>
                       <p>{{$property->address }}</p>
                       
                   </div>
                   
                   <div class="mb-3 d-flex flex-row">
                   <p class="fw-bold">Property Description<p>
                           <p class="mx-3"> : </p>
                       <p>{{$property->description }}</p>
                       
                   </div>

                   <div class="mb-3 d-flex flex-row">
                   <p class="fw-bold"> Price<p>
                           <p class="mx-3"> : </p>
                       <p>{{$property->price }}</p>
                       
                   </div>
                   
    
                   

                  
                   <div class=" mb-3 d-flex flex-row">
                   <p class="fw-bold"> Property Type<p>
                           <p class="mx-3"> : </p>
                       <p>{{$property->type }}</p>
                       
                   </div>
                   <div class=" mb-3 d-flex flex-row">
                   <p class="fw-bold"> Bought From<p>
                           <p class="mx-3"> : </p>
                       <p>{{$owner->email }}</p>
</div>
</div>
<div class="col-12">
    
@if($iscomments)
<h6>Comments</h6>
<div class="p-5 shadow rounded mb-3">
@foreach($comments as $comment)
<div class="mb-3 d-flex flex-row rounded bg-white  ">
                   <p class="fw-bold">{{$comment->commenter}}<p>
                           <p class="mx-3"> : </p>
                       <p>{{$comment->comment}}</p>
                       
                    
</div>
@endforeach
</div>
@else
<h6 class="mb-3 d-flex rounded bg-white shadow p-5">No comments yet.</h6>
@endif

<div class="col-9 text-center rounded shadow py-1" style="height:50px;width:600px;">
You own this property.
                       </div>
</div>
</div>              
        </div>
        <div class="col-md-6 d-md-block ">

        
        <img src="{{asset('images/'.$property->image)}}" width="500px" height="350px" alt="..." class="img-fluid mb-5">
        
            
        <div class="card border-0 rounded bg-white shadow mb-3"  >

            <div class="card-body">
                   <div id="map" style="height:300px;">

                   </div>
                   <script>
                      let map;
                    function initMap() {
                        map = new google.maps.Map(document.getElementById("map"), {
                            center: { lat: {{$location->latitude}}, lng:  {{$location->longitude}} },
                            zoom: 8,
                            scrollwheel: true,
                        });
                        const uluru = { lat: {{$location->latitude}}, lng: {{$location->longitude}} };
                        let marker = new google.maps.Marker({
                            position: uluru,
                            map: map,
                            draggable: false
                        });
                       
                    }
                   </script>  
                  
                </div>

                  
                </div>
            
                  

       
    </div>
   
</div>

</div>

<script async defer type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxl13g2FaVZDr8XrjwcqyIgRxKy0PR07U&libraries=places&callback=initMap"></script>
    
@stop