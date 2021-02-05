<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
         {{-- icon --}}
         <link rel="icon" href="">

         <!-- Fonts -->
         <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
 
         <!-- Styles -->
         {{-- Custom --}}
         <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,700,900|Roboto+Mono:300,400,500"> 
        <link rel="stylesheet" href="/css/bootstrap-datepicker.css">

         {{-- Bootstrap --}}
         <link rel="stylesheet" href="/css/bootstrap-reboot.css">
         <link rel="stylesheet" href="/css/bootstrap-grid.min.css">
         <link rel="stylesheet" href="/css/bootstrap.min.css">
 
         {{-- Font Awesome --}}
         <link rel="stylesheet" href="/css/all.min.css">
 
         {{-- App.css --}}
         <link href="{{ asset('css/app.css') }}" rel="stylesheet">
 
         {{-- Public css --}}        
        <link rel="stylesheet" href="/css/style.css">
 
         {{-- Csrf --}}
         <script>
            
             (function () {
                 window.Laravel = {
                     csrfToken: '{{ csrf_token() }}'
                 };
             })();
           
         </script>

        

        {{-- Csrf --}}
        <script>
            
            (function () {
                window.Laravel = {
                    csrfToken: '{{ csrf_token() }}'
                };
            })();
          
        </script>

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="container-fluid mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Eagle Bug Tracker') }}
                    </h2>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>

            {{-- Mix JS for Vue --}}
            <script type="text/javascript" src="{{ mix('js/app.js') }}" ></script>

            {{-- JQuery --}}
            <script type="text/javascript" src="js/jquery.min.js"></script>

            {{-- Bootstrap --}}
            <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
            <script type="text/javascript" src="js/bootstrap.min.js"></script>
            {{-- Util Js --}}
            <script type="text/javascript" src="js/util.js"></script>

            {{-- Font Awesome --}}
            <script type="text/javascript" src="js/all.min.js"></script>

            {{-- Custom --}}
            <script src="/js/jquery-migrate-3.0.1.min.js"></script>
            <script src="/js/jquery-ui.js"></script>
            <script src="/js/popper.min.js"></script>
            <script src="/js/bootstrap.min.js"></script>
            <script src="/js/bootstrap-datepicker.min.js"></script>

            
        </div>
    </body>
</html>
