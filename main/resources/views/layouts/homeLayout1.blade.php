<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">  
    <style>
        #intro{
            padding:60px 0px;
            margin:0  10px;
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
        .logo img{
            max-width:70%;
        }
        input:focus{
            box-shadow:none;
        }
        .submit-btn{
            padding:15px;
            font-weight:500;
        }
        .submit-btn:focus,.login_with:focus{
            box-shadow:none;
        }
        .login_with{
            padding:15px;
            font-size:15px;
            font-weight:500;
            transition:0.3s ease-in-out;

        }

    </style>
     <!-- Fonts -->
     <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
</head>
<body >
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
                   
                    <li class="nav-item d-none d-md-inline me-2">
                        <a href="/register" class="btn"  style="background-color:#E27D60; color:white;">Sign Up</a>
                    </li>
                    <li class="nav-item  d-md-inline">
                        <a href="/login" class="btn"  style="background-color:#5DD1A4; color:white;">Login</a>
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
    
    <script>
        const tooltips=document.querySelectorAll('.tt')
        tooltips.forEach(
            t=>{
                new bootstrap.Tooltip(t)
            }
        )
    </script>
</body>
</html>