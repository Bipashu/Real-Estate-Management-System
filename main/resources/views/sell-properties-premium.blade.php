


@extends('layouts.premiumUserLayout')

@section('content')
<div class="container-lg">
    <div class="text-start">
        <h5 style="color:#E8A87C;"> Sell Properties</h5>
      
    </div>
    <div class="col-md-12 text-center ms-4 d-md-block">
            <div class="d-flex justify-content-center align-items-center bg-image img-fluid " style="background-image:url('images/house.png'); height:50vh; background-repeat:no-repeat;  background-size: cover;"> 
            <div class="mask w-100" style="background-color: rgba(0, 0.7, 0, 0.6)"> 
            <div class="d-flex justify-content-center align-items-center h-100 w-100" >
                  <form action="" class="col-9">
                  <div class="form-floating mb-3 ">
                       <input type="search" class="form-control bg-light border border-white @error('address') is-invalid @enderror" id="address" name="search" placeholder="address">
                       <script type="text/javascript">
                           $(document).ready(function(){
                               var autocomplete;
                               var id='address';
                               autocomplete=new google.maps.places.Autocomplete((document.getElementById(id)),{
                                   types:['geocode'],
                               })

                               google.maps.event.addListener(autocomplete,'place_changed',function(){
                                   var place=autocomplete.getPlace();
                                   jQuery('#lat').val(place.geometry.location.lat());
                                   jQuery('#lng').val(place.geometry.location.lng());
                               })

    

                           });

                       </script>
                       @error('address')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                   @enderror
                       <label for="floatingName" class="text-muted">Search by location or price...</label>
                       <button type="search"class="btn submit-btn w-25 my-2 text-white" style="background-color:#E8A8C7;">Search</button>
                  
                   </div>
                   
                  
                  </form>
            </div>
        </div>  
    </div>
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
                      
                       
                     
                       <a href={{"detailssell/".$property->id}} class="text-decoration-none">Details</a>
                       </div>
                       <div class="col-6 text-end">
                       
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
