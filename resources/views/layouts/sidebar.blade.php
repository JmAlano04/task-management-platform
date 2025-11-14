<div class="flex flex-col items-center py-6 space-y-8">

    <!-- Logo -->
    <div class="mb-4">
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10 h-10 rounded-full shadow-md hover:scale-105 transition duration-300">
        </a>
    </div>
    <ul class="space-y-6 text-md text-gray-100">

    <!-- Dashboard -->
<li class="group">
    <a href="{{ route('dashboard') }}"
       class="flex items-center justify-center w-12 h-12 rounded-lg transition-all duration-300
              {{ request()->routeIs('dashboard') 
                    ? 'bg-white text-pink-600 shadow-md' 
                    : 'hover:bg-pink-500 hover:shadow-lg' }}">
       
        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-6 h-6 transition-all duration-300
                    {{ request()->routeIs('dashboard') 
                        ? 'stroke-pink-600' 
                        : 'stroke-white group-hover:stroke-white' }}"
             fill="pink" viewBox="0 0 640 640">
            
            <path d="M341.8 72.6C329.5 61.2 310.5 61.2 298.3 72.6L74.3 280.6C64.7 289.6 61.5 303.5 66.3 315.7C71.1 327.9 82.8 336 96 336L112 336L112 512C112 547.3 140.7 576 176 576L464 576C499.3 576 528 547.3 528 512L528 336L544 336C557.2 336 569 327.9 573.8 315.7C578.6 303.5 575.4 289.5 565.8 280.6L341.8 72.6zM304 384L336 384C362.5 384 384 405.5 384 432L384 528L256 528L256 432C256 405.5 277.5 384 304 384z"/>
        </svg>

    </a>
</li>

     @if(Auth::user()->role === 'admin')
        @include('profile.partials.sidebar.admin-sidebar')
    @elseif(Auth::user()->role === 'creator')
        @include('profile.partials.sidebar.creator-sidebar')
     @elseif(Auth::user()->role === 'taker')
         @include('profile.partials.sidebar.taker-sidebar')
    @endif






        <!-- Tasks -->
        {{-- <li class="group">
            <a href="{{ route('tasks.index') }}"
               class="flex items-center justify-center w-12 h-12 rounded-lg transition duration-300 
                      {{ request()->routeIs('tasks.*') ? 'bg-white text-pink-600' : 'hover:bg-pink-500' }}">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-6 h-6 transition duration-300
                            {{ request()->routeIs('tasks.*') ? 'stroke-pink-600' : 'stroke-white group-hover:stroke-white' }}"
                     fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12h6m-3-3v6m6-9a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </a>
        </li> --}}

        <!-- Settings -->
        {{-- <li class="group">
            <a href="{{ route('settings') }}"
               class="flex items-center justify-center w-12 h-12 rounded-lg transition duration-300 
                      {{ request()->routeIs('settings') ? 'bg-white text-pink-600' : 'hover:bg-pink-500' }}">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-6 h-6 transition duration-300
                            {{ request()->routeIs('settings') ? 'stroke-pink-600' : 'stroke-white group-hover:stroke-white' }}"
                     fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10.325 4.317a1 1 0 011.35 0l1.45 1.255a8.001 8.001 0 012.829 1.646l1.638-.327a1 1 0 011.182.769l.3 1.503a8.003 8.003 0 010 3.992l-.3 1.503a1 1 0 01-1.182.769l-1.638-.327a8.001 8.001 0 01-2.829 1.646l-1.45 1.255a1 1 0 01-1.35 0l-1.45-1.255a8.001 8.001 0 01-2.829-1.646l-1.638.327a1 1 0 01-1.182-.769l-.3-1.503a8.003 8.003 0 010-3.992l.3-1.503a1 1 0 011.182-.769l1.638.327a8.001 8.001 0 012.829-1.646l1.45-1.255z" />
                </svg>
            </a>
        </li> --}}
    </ul>
</div>
