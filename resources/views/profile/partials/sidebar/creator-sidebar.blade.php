<!-- Create Task Button -->
<li class="group">
    <a href="{{ route('createTask') }}"
       class="flex items-center w-48 h-12 px-3 rounded-lg transition-all duration-300
              {{ request()->routeIs('createTask') 
                  ? 'bg-gray-200 text-gray-900 shadow-lg' 
                  : 'hover:bg-gray-100 hover:shadow-md text-gray-700' }}">
        
        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-6 h-6 transition-colors duration-300
                    {{ request()->routeIs('createTask') 
                        ? 'stroke-gray-900' 
                        : 'stroke-gray-700 group-hover:stroke-gray-900' }}"
             fill="currentColor" viewBox="0 0 640 640">
            <path d="M320 576C461.4 576 576 461.4 576 320C576 178.6 461.4 64 320 64C178.6 64 64 178.6 64 320C64 461.4 178.6 576 320 576zM296 408L296 344L232 344C218.7 344 208 333.3 208 320C208 306.7 218.7 296 232 296L296 296L296 232C296 218.7 306.7 208 320 208C333.3 208 344 218.7 344 232L344 296L408 296C421.3 296 432 306.7 432 320C432 333.3 421.3 344 408 344L344 344L344 408C344 421.3 333.3 432 320 432C306.7 432 296 421.3 296 408z"/>
        </svg>

        <span class="ml-3 font-medium text-[13px]  text-gray-700 group-hover:text-gray-900 transition-colors duration-300">
            Create Task
        </span>
    </a>
</li>