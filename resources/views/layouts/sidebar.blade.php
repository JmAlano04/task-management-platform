
<div class="flex flex-col items-center py-6 space-y-8">


    <!-- Logo -->
    <div class="mb-4">
        <a href="{{ route('dashboard') }}">
            HIREABLE PH        
        </a>
    </div>
    <ul class="space-y-6 text-md text-gray-100">

<!-- Dashboard -->
<li class="group">
    <a href="{{ route('dashboard') }}"
       class="flex items-center w-48 h-12 px-3 rounded-lg transition-all duration-300
              {{ request()->routeIs('dashboard') 
                  ? 'bg-gray-200 text-gray-900 shadow-lg' 
                  : 'hover:bg-gray-100 hover:shadow-md text-gray-700' }}">
       
        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-6 h-6 transition-colors duration-300
                    {{ request()->routeIs('dashboard') 
                        ? 'stroke-gray-900' 
                        : 'stroke-gray-700 group-hover:stroke-gray-900' }}"
             fill="black" viewBox="0 0 640 640">
            <path d="M341.8 72.6C329.5 61.2 310.5 61.2 298.3 72.6L74.3 280.6C64.7 289.6 61.5 303.5 66.3 315.7C71.1 327.9 82.8 336 96 336L112 336L112 512C112 547.3 140.7 576 176 576L464 576C499.3 576 528 547.3 528 512L528 336L544 336C557.2 336 569 327.9 573.8 315.7C578.6 303.5 575.4 289.5 565.8 280.6L341.8 72.6zM304 384L336 384C362.5 384 384 405.5 384 432L384 528L256 528L256 432C256 405.5 277.5 384 304 384z"/>
        </svg>

        <span class="ml-3 font-medium text-[13px]  text-gray-700 group-hover:text-gray-900 transition-colors duration-300">
            Dashboard
        </span>
    </a>
</li>

     @if(Auth::user()->role === 'admin')
        @include('profile.partials.sidebar.admin-sidebar')
    @elseif(Auth::user()->role === 'creator')
        @include('profile.partials.sidebar.creator-sidebar')
     @elseif(Auth::user()->role === 'taker')
         @include('profile.partials.sidebar.taker-sidebar')
    @endif

    </ul>

</div>
