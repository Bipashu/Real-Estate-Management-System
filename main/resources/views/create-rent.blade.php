@extends('layouts.premiumUserLayout')

@section('content')

<div class="container-lg">
<div class="text-start">
        <h5 style="color:#E8A87C;">Register Rent Properties</h5>
    </div>
    <form action="{{route('rent-property-models.created')}}" method="POST" class="rounded bg-white shadow p-5" enctype="multipart/form-data">
    @csrf
    <div class="row justify-content-center align-items-center">
   
        <div class="col-md-5 text-center text-md-start">
            
       
               
              
                   <div class="form-floating mb-3">
                       <input type="text" class="form-control bg-light border border-white @error('name') is-invalid @enderror" id="floatingInput" name="name" placeholder="name">
                       @error('name')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                   @enderror
                       <label for="floatingName" class="text-muted">Property Name</label>
                   </div>
                   <div class="form-floating mb-3">
                       
                       <input type="file" name="image"  class="form-control text-muted border border-white @error('image') is-invalid @enderror" id="floatingInput">
                       @error('image')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                   @enderror
                      
                   </div>
                   <div class="form-floating mb-3">
                       <input type="text" class="form-control bg-light border border-white @error('address') is-invalid @enderror" id="address" name="address" placeholder="address">
                       <input type="hidden" class="form-control" name="latitude" id="lat" placeholder="lat">
                       <input type="hidden" class="form-control" name="longitude"id="lng" placeholder="lng">
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
                       <label for="floatingName" class="text-muted">Property Address</label>
                   </div>
    
                   <div class="form-floating mb-3">
  <textarea class="form-control bg-light border border-white @error('description') is-invalid @enderror" id="comment"  placeholder="description" name="description"></textarea>
  @error('description')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                   @enderror
                       
  <label for="floatingName" class="text-muted">Description here..</label>
</div>
                   <button type="submit"class="btn submit-btn w-25 my-4 text-white" style="background-color:#E8A8C7;">Create</button>
                  
               
        </div>
        <div class="col-md-5 text-center d-md-block">
        <div class="form-floating mb-3">
                       <input type="text" class="form-control bg-light border border-white @error('price') is-invalid @enderror" id="floatingInput" name="price" placeholder="price">
                       @error('price')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                   @enderror
                       <label for="floatingName" class="text-muted">Price</label>
                   </div>
                  
                   <div class="form-floating mb-3">
                   <select class="form-select bg-light border border-white text-muted @error('type') is-invalid @enderror" id="floatingInput" name="type" placeholder="type" >
  
  <option value="Residential">Residential</option>
  <option value="Garage">Garage</option>
  <option value="Apartment">Apartment</option>
  <option value="Room">Room</option>
  <option value="Commercial">Commercial</option>
  <option value="Other">Other</option>
</select>

                       @error('type')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                   @enderror
                       <label for="floatingName" class="text-muted"></label>
                   </div>
                   
                  
        </div>  
       
    </div>
   
</div>
</form>
</div>


@stop