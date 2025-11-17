<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Defaut title'}}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

         @livewireStyles
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

             <!-- Sidebar -->
            <aside class= "w-56 h-screen fixed top-0 left-0 bg-white shadow-md flex flex-col items-center rounded-r-xl">
                @include('layouts.sidebar')
            </aside>


                 
              <!-- Main Content -->
            <div class="flex-1 ml-[220px]  ">
                @include('layouts.navigation')

                <!-- Page Heading -->
                @isset($header)
                    <header">
                        <div class="max-w-2xl mt-9">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main>
                    
                 
                  {{ $slot ?? '' }}

                  
                  @livewireScripts
                </main>

                
            </div>
        </div>
    </body>
</html>
