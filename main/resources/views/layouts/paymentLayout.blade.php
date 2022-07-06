
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet"
  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
  integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
  crossorigin="anonymous">
<link rel="stylesheet"
  href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">  
    <style>
        #intro{
            padding:60px 0;
        }
        footer{
            padding:0px 10px;
        }
        nav{
            padding:0px 10px;
        }
        .wrapper{
            padding: 0 0 100px;
            background-image:URL('images/bg.png');
            background-position:bottom center;
            background-repeat:no-repeat;
            background-size:contain;
            background-attachment:fixed;
            min-height:100%;
        }
        .panel-title {
         display: inline;
         font-weight: bold;
         }
         .display-table {
         display: table;
         }
         .display-tr {
         display: table-row;
         }
         .display-td {
         display: table-cell;
         vertical-align: middle;
         width: 61%;
         }
    </style>
     <!-- Fonts -->
     <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
   

   

</head>
<body>
    <!--navbar-->
    <nav class="navbar navbar-expand-md navbar-dark mx-2 mt-2 py-3" style="background-color:#41B3A3; font-size:16px;">
        <div class="container-xxl">
            <a href="#intro" class="navbar-brand" style="font-size:20px;">
                <span class="text-white text-muted">
                    <i class="bi bi-bank2"></i>
                    RPA- Real Property Admininstration
                </span>
            </a>
            <!--toggle button for mobile nav-->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav"
            aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!--navbar links-->
            <div class="collapse navbar-collapse justify-content-end align-center" id="main-nav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="/" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item dropdown" >
                        <a class="nav-link dropdown-toggle" href="{{route('property')}}" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Browse
                        </a>
                        <ul class="dropdown-menu text-white" aria-labelledby="navbarDarkDropdownMenuLink" style="background-color:#E8A87C">
                            <li><a class="dropdown-item small text-white" href="/rent-property">Browse Properties To Rent</a></li>
                            <li><a class="dropdown-item small text-white" href="/sell-property">Browse Properties To Sell</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item small text-white" href="{{route('property')}}" >Your Properties</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('premium-register')}}" class="nav-link">Register As Premium User</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                             {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu text-white" aria-labelledby="navbarDarkDropdownMenuLink" style="background-color:#E8A87C">
                            <li> <a class="nav-link" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form></li>
                           
                        </ul>
                    
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section id="intro" class="wrapper">
        @yield('content')
    </section>
    <!--footer-->
    <footer>
        <div class="py-2 ps-3" style="background-color:#85DCBA; color:white;">
            © 20{{ date('y') }} Copyright:All rights reserved
        </div>
    </footer>
</body>
<script src="{{ asset('/js/card.js') }}"></script>
</html>