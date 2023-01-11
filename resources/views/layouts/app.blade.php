<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ASHPLAN') }}</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

   
    <style>
      
      html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
      }
      
      .full-height {
        height: 100vh;
      }
      
      .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
      }
      
      .position-ref {
        position: relative;
      }
      
      .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
      }
      
      .content {
        text-align: center;
        padding-top:15%;
      }
      
      .title {
        font-size: 84px;
      }
      
      .links > a {
        color: #FFFFFF;
        padding: 15px 40px;
        margin: 21px;
        font-size: 17px;
        font-weight: 700;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
        border-radius:25px;
      }
      
      
      
      .links > a:hover {
        color: rebeccapurple;
        background-color:white;
        padding: 15px 40px;
        margin: 21px;
        font-size: 17px;
        font-weight: 700;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
        border:2px solid rebeccapurple;  
      }
      
      
      .m-b-md {
        margin-bottom: 30px;
      }
      
              </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('home') }}">
              
                    <img src="{{ asset('images/logo.png') }}" style="width:75px;">
              
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                       <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @if(Auth::guard('admin')->check())
                               {{Auth::guard('admin')->user()->name}}
                            @elseif(Auth::guard('client')->check())
                              {{Auth::guard('client')->user()->name}}
                            @endif
                            <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                             

                                 <a class="dropdown-item" href="{{ url('new_ticket') }}">
                                    {{ __('New Ticket') }}
                                </a>
                                @if(Auth::guard('admin')->check())
                            
                               <a class="dropdown-item" href="{{ url('show_ticket') }}">
                                
                                    {{ __('Tickets') }}
                                </a>
                                
                              @elseif(Auth::guard('client')->check())

                                <a class="dropdown-item" href="{{ url('view_ticket') }}">

                                  {{ __('Tickets') }}
                                </a>
                                @endif
                                <a class="dropdown-item" href="{{ url('view_revision') }}">
                                
                                {{ __('Revisions') }}
                               </a>
                               <a class="dropdown-item" href="{{ url('view_edit') }}">
                               {{ __('Edits') }}
                               </a>
                                 <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>


                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>


                            </div>

                            
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>