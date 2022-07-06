



@extends('layouts.adminLayout')

@section('content')
<div class="container-lg">
    <div class="text-start">
        <h5 style="color:#E8A87C;">Rent Properties</h5>
       
    </div>
   
    <div class="row justify-content-start my-5" style="padding-left:5%;" >
    @foreach($properties as $property)
        <div class="col-lg-6 g-2">
        
            <div class="card border-0 rounded bg-white shadow p-5" >
            <img src="{{asset('images/'.$property->image)}}" width="300px" height="300px" class="card-img-top" alt="...">
                <div class="card-body text-start py-4">
                    <h4 class="card-title text-muted">{{$property->name}}</h4>
                    <p class="lead card-subtitle">{{$property->address}}</p>
                    <h2 class="text-primary">${{$property->price}}</h2>
                    <p class="card-text text-muted d-none d-lg-block">{{$property->description}}</p>
                   
                    
                   <div class="row">
                       <div class="col-6 ">
                      
                       
                       
                      
                       <a href={{"rent-details/".$property->id}} class="text-decoration-none">Details</a>
                       </div>
                       <div class="col-6 text-end">
                        <!-- <form action="/apply" method="POST">
                            @csrf
                       <button type="submit" class="btn submit-btn rounded bg-primary shadow">Apply for a rent</button>
                       </form> -->
                       </div>
                       
                       
                   </div>
                  
                 
                    
                   
                  
                </div>
            </div>
        </div>
        <!-- <div class="col-lg-6">
        
            <div class="card border-0 rounded bg-white shadow"  >

            <div class="card-body">
                   <div id="map" style="height:300px;">

                   </div>
                   <script>
                      let map;
                    function initMap() {
                        map = new google.maps.Map(document.getElementById("map"), {
                            center: { lat: -34.397, lng: 150.644 },
                            zoom: 8,
                            scrollwheel: true,
                        });
                        const uluru = { lat: -34.397, lng: 150.644 };
                        let marker = new google.maps.Marker({
                            position: uluru,
                            map: map,
                            draggable: false
                        });
                       
                    }
                   </script>  
                  
                </div>

                  
                </div>
            </div> -->

            @endforeach
        </div>
       
            </div>
           
   
</div>

@stop
