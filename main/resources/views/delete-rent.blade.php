@extends('layouts.premiumUserLayout')

@section('content')

<div class="container-lg">
<div class="text-start">
        <h5 style="color:#E8A87C;">Delete Rent Property</h5>
    </div>
    <form action="{{route('rent-property-models.deleted')}}" method="POST" class="rounded bg-white shadow p-5" enctype="multipart/form-data">
    @csrf
    <div class="row justify-content-center align-items-center">
   
        <div class="col-md-5 text-center text-md-start">
            
       
               
              
                   <div class="form mb-3">
                   <label for="floatingName" class="text-muted">Property Name</label>
                   <input type="hidden" name="id" value= " {{ $property->id }} "class="form-control border border-light border-3" style="background-color:#e4edf5;" id="id">
  
                       <input type="text"  readonly class="form-control bg-light border border-white @error('name') is-invalid @enderror" value= " {{ $property->name }} " id="floatingInput" name="name" placeholder="name">
                       @error('name')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                   @enderror
                       
                   </div>
                   
                   <div class="form mb-3">
                   <label for="floatingName" class="text-muted">Property Address</label>
                       <input type="text" readonly class="form-control bg-light border border-white @error('address') is-invalid @enderror" value= " {{ $property->address }} "id="address" name="address" placeholder="address">
        
                       
                       @error('address')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                   @enderror
                       
                   </div>
    
                   <div class="form mb-3">
                   <label for="floatingName" class="text-muted">Description here..</label>
  <input type="text" readonly class="form-control bg-light border border-white @error('description') is-invalid @enderror" value= " {{ $property->description }} " id="comment"  placeholder="description" name="description">
  @error('description')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                   @enderror
                       
 
</div>
<div class="form mb-3">
<label for="floatingName" class="text-muted">Price</label>
                       <input type="text" readonly value= " {{ $property->price }} " class="form-control bg-light border border-white @error('price') is-invalid @enderror" id="floatingInput" name="price" placeholder="price">
                       @error('price')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                   @enderror
                      
                   </div>
                  
                   <div class="form mb-3">
                   <label for="floatingName" class="text-muted">Property Type</label>
                   <input type="text" readonly value= " {{ $property->type }} " class="form-control bg-light border border-white @error('price') is-invalid @enderror" id="floatingInput" name="type" placeholder="type">
                      

                       @error('type')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                   @enderror
                      
                   </div>
                   <button type="submit"class="btn submit-btn w-25 my-4 text-white" style="background-color:#fa020b">Delete</button>
                 
               
        </div>
        <div class="col-md-5 d-md-block">
        
        <img src="{{asset('images/'.$property->image)}}" width="500px" height="350px" alt="..." class="img-fluid mb-5">
        <a href="{{ route('rent-property-models')}}" class="text-decoration-none">Back to list</a>      
                  
        </div>  
       
    </div>
   
</div>
</form>
</div>


@stop