@extends('layouts.homeLayout')

@section('content')

<div class="container-lg">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-5 text-center text-md-start">
            <h1>
                <div class="h5 text-muted">
                    Join Us and Discover the Best Real Estate Deals!!
                </div>
            </h1>
            <p class="lead my-4 text-muted">
                For the past ten years, this company has provided exceptional service to the real estate market. It has been proven to be a completely verifiable and trustworthy source with complete transparency. Find amazing properties here, ranging from luxury to minimalism, including garages, apartments, and houses for rent or purchase.  
            </p>
            <a href="/register" class="btn btn-lg text-white" style="background-color:#E27D60;">Register Now !</a>
            <a href="#sidebar" class="d-block mt-3 text-decoration-none" data-bs-toggle="offcanvas"
            style="color:#60C5E2;" role="button" aria-controls="sidebar">
                Click here for contact details
            </a>
        </div>
        <div class="col-md-5 text-center d-none d-md-block">
            <div class="d-flex justify-content-center align-items-center bg-image img-fluid " style="background-image:url('images/house.png'); height:50vh; background-repeat:no-repeat;  background-size: cover;"> 
            <div class="mask w-100" style="background-color: rgba(0, 0.7, 0, 0.6)"> 
            <div class="d-flex justify-content-center align-items-center h-100 w-100" >

            </div>
        </div>  
    </div>
</div>

</div>
@stop
<!--describing section-->
@section('cards')
<div class="container-lg">
    <div class="text-center">
        <h5 class="text-muted">Describing Section</h5>
        <p class="lead text-muted">
           Choose us, because why not?!
        </p>
    </div>
    <div class="row my-5 align-items-center justify-content-center g-0">
        <div class="col-8 col-lg-4 col-xl-3">
            <div class="card border-0">
                <div class="card-body text-center py-4">
                    <h4 class="card-title text-muted">Fully Automated</h4>
                    <p class="lead card-subtitle">Automated processes only</p>
                    <i class="fas fa-tv fa-4x py-3" style="color:#DCBA85"></i>
                   
                    <p class="card-text mx-5 text-muted d-none d-lg-block">Our products works on any platform for equal services to all.

                    </p>
                  
                </div>
            </div>
        </div>
        <div class="col-9 col-lg-4">
            <div class="card border-2" style="border-color:#C38D9E">
                <div class="card-body text-center py-5">
                    <h4 class="card-title text-muted">Complete Transparency</h4>
                    <p class="lead card-subtitle">Nothing is hidden</p>
                    <i class="fas fa-globe fa-4x py-3"  style="color:#BA85DC"></i>
                   
                    <p class="card-text mx-5 text-muted d-none d-lg-block">Don't Believe Us, See for yourself!!!
                   
                    
                    </p>
                    <a href="/register" class="btn btn-lg mt-3 text-white" style="background-color:#E8A87C;">Sign Up!</a>
                  
                </div>
            </div>
        </div>
        <div class="col-8 col-lg-4 col-xl-3">
            <div class="card border-0">
                <div class="card-body text-center py-4">
                    <h4 class="card-title text-muted">Verified</h4>
                    <p class="lead card-subtitle">Accurate and justified</p>
                    <i class="fas fa-certificate fa-4x py-3"  style="color:#D2DC85;"></i>
                   
                    <p class="card-text mx-5 text-muted d-none d-lg-block">Completely Verified and Trustable Source

                    </p>
                  
                </div>
            </div>
        </div>
        

    </div>
</div>
@stop
@section('accordian')
<div class="container-md">
    <div class="text-center">
        <h2 class="text-muted">Inside....</h2>
        <p class="lead text-muted">An auction site for real estates</p>
    </div>
    <div class="row my-5 g-5 justify-content-around align-items-center">
        <div class="col-6 col-lg-6 d-none d-md-block">
       
            <div class="d-flex justify-content-center align-items-center bg-image img-fluid " style="background-image:url('images/house1.jpg'); height:50vh; background-repeat:no-repeat;  background-size: cover;"> 
            <div class="mask w-100" style="background-color: rgba(0.7, 0, 0, 0.6)"> 
            <div class="d-flex justify-content-center align-items-center h-100 w-100" >

            </div>
        </div>  
    </div>

        </div>
        <div class="col-lg-6">
        <div class="accordion"  id="chapters">
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading-1">
                    <button class="accordion-button text-white" type="button" data-bs-toggle="collapse" data-bs-target="#chapter-1"
                    aria-expanded="true" aria-controls="chapter-1" style="background-color:#E27D60;">Multiple user facilities</button>

                </h2>
                <div id="chapter-1" class="accordion-collapse collapse show" aria-labelledby="heading-1" data-bs-parent="#chapters">
                    <div class="accordion-body">
                        <p>You can register to our system as a potential buyer and also as seller. When you are registsred first, you are registered as a buyer.
                            This makes you able to purchase properties inlisted in the site.
                            You can then purchase your premium user authority and sell or rent your properties by inlisting them. 
                        </p>
                    </div>

                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading-2">
                    <button class="accordion-button text-white" type="button" data-bs-toggle="collapse" data-bs-target="#chapter-2"
                    aria-expanded="true" aria-controls="chapter-2"  style="background-color:#E2BE60;">Multiple property types</button>

                </h2>
                <div id="chapter-2" class="accordion-collapse collapse show" aria-labelledby="heading-2" data-bs-parent="#chapters">
                    <div class="accordion-body">
                        <p>You have various choices in type for property listing and buying. There are altogther six property types you can choose from.</p>
                    </div>

                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading-3">
                    <button class="accordion-button text-white" type="button" data-bs-toggle="collapse" data-bs-target="#chapter-3"
                    aria-expanded="true" aria-controls="chapter-3" style="background-color:#E26084;">Bidding facility</button>

                </h2>
                <div id="chapter-3" class="accordion-collapse collapse show" aria-labelledby="heading-3" data-bs-parent="#chapters">
                    <div class="accordion-body">
                        <p>As a buyer, you can place bid on selling properties.You can sell the property by accepting the bid, as a seller.</p>
                    </div>

                </div>
            </div>

        </div>
        </div>
    </div>
</div>
@stop
@section('types')
<div class="container-lg">
    <div class="text-center">
        <h3 class="text-muted"> <i class="bi bi-card-list me-2"></i>Categories</h2>
        <p class="lead">All the property types...</p>
    </div>
    <div class="row justify-content-center my-5" >
        <div class="col-lg-8">
            <div class="list-group" >
                <div class="list-group-item py-3" style="background-color:#E27D60;">
                    <p class="mb-1 text-white " > Residential  </p>
                   
                </div>
                <div class="list-group-item py-3" style="background-color:#85DCBA;">
                    <p class="mb-1 text-white" >Garage</p>
                    
                </div>
                <div class="list-group-item py-3"  style="background-color:#E8A87C;">
                    <p class="mb-1 text-white">Apartment</p>
                    
                </div>
                <div class="list-group-item py-3"  style="background-color:#C38D9E;">
                    <p class="mb-1 text-white">Room</p>
                    
                </div>
                <div class="list-group-item py-3"  style="background-color:#41B3A3;">
                    <p class="mb-1 text-white">Commercial</p>
                    
                </div>
                <div class="list-group-item py-3" style="background-color:#E2BE60">
                    <p class="mb-1 text-white" >Other</p>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('form')
<div class="container-lg">
    <div class="text-center">
        <h2 class="text-muted">Get in touch...</h2>
        <p class="lead">Questions to ask? Fill out the form to contact us directly...</p>
    </div>
    <div class="row justify-content-center my-5">
        <div class="col-lg-6">
            <form action="{{ route('query')}}" method="POST">
                @csrf
                <label for="email" class="form-label">Email address:</label>
                <div class="mb-4 input-group">
                    <span class="input-group-text">
                    <i class="bi bi-envelope-fill"></i>
                    </span>
                <input type="email" class="form-control" id="email" name="email" placeholder="e.g. james@example.com">
                <span class="input-group-text">
                    <span class="tt" data-bs-placement="bottom" title="Enter an email address we can reply to.">
                    <i class="bi bi-question-circle text-muted"></i>
                    </span>
                    </span>
                </div>
                
                <label for="name" class="form-label">Name:</label>
                <div class="mb-4 input-group">
                <span class="input-group-text">
                    <i class="bi bi-person-fill"></i>
                    </span>
                <input type="text" class="form-control" id="name" name="name" placeholder="e.g. James">
                <span class="input-group-text">
                    <span class="tt" data-bs-placement="bottom" title="Pretty self explanatory really..">
                    <i class="bi bi-question-circle text-muted"></i>
                    </span>
                    </span>
                </div>
                <label for="subject" class="form-label">What is your question about?</label>
                <div class="mb-4 input-group">
                    <span class="input-group-text">
                    <i class="bi bi-chat-right-dots-fill"></i>
                    </span>
                <select class="form-select" id="subject" name="query">
                    <option value="pricing" selected>Pricing Query</option>
                    <option value="content" >Content Query</option>
                    <option value="other" >Other Query</option>
                </select>
                </div>
                
                <!-- <div class="form-floating mb-4 mt-5">
                    <textarea class="form-control" id="query" style="height:140px;"></textarea>
                    <label for="query" class="form-label">Your query..</label>
                </div> -->
                <div class="mb-4 text-center">
                    <button type="submit" class="btn"  style="background-color:#5DD1A4; color:white;">Submit</button>
                </div>
               
            </form>
        </div>

    </div>
</div>

<div class="offcanvas offcanvas-bottom text-white" tabindex="-1" id="sidebar" aria-labelledby="sidebar-label" style="padding:0 10px; background-color:#84E260;">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebar-label">
                Contact Us
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body" >
            <p>Get connected with us on social networks:</p>
            <div>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-facebook-f fa-2x"  style="color:#2835c7"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-twitter fa-2x" style="color:#00acee;"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-google fa-2x " style="color: #db3236;"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-instagram fa-2x" style="color:#bc2a8d;"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-linkedin fa-2x" style="color:#0e76a8"></i>
      </a>
    </div>
        </div>

    </div>
@stop