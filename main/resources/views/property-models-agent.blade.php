
@extends('layouts.agentLayout');

@section('content')
<div class="container-lg">
    <div class="text-start">
        <h5 style="color:#E8A87C;">All Properties</h5>
        
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
                    @if($property->rent_id == null)
                    <p class="card-text text-muted d-none d-lg-block">Sell Mode</p>
                    @else
                    <p class="card-text text-muted d-none d-lg-block">Rent Mode</p>
                    @endif
                   <div class="row">
                       <div class="col-6 ">
                       
                       @if($property->rent_id == null)
                       <a href={{"sellDetails/".$property->sell_id}} class="text-decoration-none">Details</a>
                       @else
                       <a href={{"rentDetails/".$property->rent_id}} class="text-decoration-none">Details</a>
                       @endif
                       </div>
                       <div class="col-6 text-end">
                       @if($property->property_status!='booked')
                        @if($property->rent_id == null)
                       <a href={{"verifySell/".$property->sell_id}} class="text-decoration-none pe-2 border-end"><i class="fa fa-thumbs-up" aria-hidden="true" style="color:#19a641;"></i></a>
                       <a href={{"disapproveSell/".$property->sell_id}} class="text-decoration-none"><i class="fa fa-thumbs-down" aria-hidden="true" style="color:#a10b18;"></i></a>
                       @else
                       <a href={{"verifyRent/".$property->rent_id}} class="text-decoration-none pe-2 border-end"><i class="fa fa-thumbs-up" aria-hidden="true" style="color:#19a641;"></i></a>
                       <a href={{"disapproveRent/".$property->rent_id}} class="text-decoration-none"><i class="fa fa-thumbs-down" aria-hidden="true" style="color:#a10b18;"></i></a>
                       @endif

                       @endif
                       </div>
                       
                       
                   </div>
                  
                   <p class="text-muted">{{$property->property_status}}</p>
                    
                   
                  
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

