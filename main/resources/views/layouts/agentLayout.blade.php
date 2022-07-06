<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
   <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxl13g2FaVZDr8XrjwcqyIgRxKy0PR07U&libraries=places&callback=initMap"></script>
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
    </style>
</head>
<body>
    <!--navbar-->
    <nav class="navbar navbar-expand-md navbar-dark mx-2 mt-2" style="background-color:#41B3A3;">
        <div class="container-xxl">
            <a href="#intro" class="navbar-brand">
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
                    <li class="nav-item">
                        <a href="property-models-agent" class="nav-link">Manage Properties</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Browse Properties
                        </a>
                        <ul class="dropdown-menu text-white" aria-labelledby="navbarDarkDropdownMenuLink" style="background-color:#E8A87C">
                            <li><a class="dropdown-item small text-white" href="/Rentproperty">Browse Properties To Rent</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item small text-white" href="/Sellproperty">Browse Properties To Sell</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                   {{ session()->get('name');}}
                        </a>
                        <ul class="dropdown-menu text-white" aria-labelledby="navbarDarkDropdownMenuLink" style="background-color:#E8A87C">
                            <li> <a class="nav-link" href="/agentlogout"
           >
           Logout
        </a>

       </li>
                           
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
</html>