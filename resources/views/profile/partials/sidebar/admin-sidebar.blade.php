<li class="group">
    <a href="{{ route('task-management') }}"
       class="flex items-center w-48 h-12 px-3 rounded-lg transition-all duration-300
              {{ request()->routeIs('task-management') 
                  ? 'bg-gray-200 text-gray-900 shadow-lg' 
                  : 'hover:bg-gray-100 hover:shadow-md text-gray-700' }}">
        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-6 h-6 transition-colors duration-300
                    {{ request()->routeIs('task-management') 
                        ? 'stroke-gray-900' 
                        : 'stroke-gray-700 group-hover:stroke-gray-900' }}"
             fill="black" viewBox="0 0 640 640">
            <path d="M197.8 100.3C208.7 107.9 211.3 122.9 203.7 133.7L147.7 213.7C143.6 219.5 137.2 223.2 130.1 223.8C123 224.4 116 222 111 217L71 177C61.7 167.6 61.7 152.4 71 143C80.3 133.6 95.6 133.7 105 143L124.8 162.8L164.4 106.2C172 95.3 187 92.7 197.8 100.3zM197.8 260.3C208.7 267.9 211.3 282.9 203.7 293.7L147.7 373.7C143.6 379.5 137.2 383.2 130.1 383.8C123 384.4 116 382 111 377L71 337C61.6 327.6 61.6 312.4 71 303.1C80.4 293.8 95.6 293.7 104.9 303.1L124.7 322.9L164.3 266.3C171.9 255.4 186.9 252.8 197.7 260.4zM288 160C288 142.3 302.3 128 320 128L544 128C561.7 128 576 142.3 576 160C576 177.7 561.7 192 544 192L320 192C302.3 192 288 177.7 288 160zM288 320C288 302.3 302.3 288 320 288L544 288C561.7 288 576 302.3 576 320C576 337.7 561.7 352 544 352L320 352C302.3 352 288 337.7 288 320zM224 480C224 462.3 238.3 448 256 448L544 448C561.7 448 576 462.3 576 480C576 497.7 561.7 512 544 512L256 512C238.3 512 224 497.7 224 480zM128 440C150.1 440 168 457.9 168 480C168 502.1 150.1 520 128 520C105.9 520 88 502.1 88 480C88 457.9 105.9 440 128 440z"/>
        </svg>
        <span class="ml-3 font-medium text-gray-700 group-hover:text-gray-900 transition-colors duration-300">
            Task Management
        </span>
    </a>
</li>

<li class="group">
    <a href="{{ route('manage-account') }}"
       class="flex items-center w-48 h-12 px-3 rounded-lg transition-all duration-300
              {{ request()->routeIs('manage-account') 
                  ? 'bg-gray-200 text-gray-900 shadow-lg' 
                  : 'hover:bg-gray-100 hover:shadow-md text-gray-700' }}">
        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-6 h-6 transition-colors duration-300
                    {{ request()->routeIs('manage-account') 
                        ? 'stroke-gray-900' 
                        : 'stroke-gray-700 group-hover:stroke-gray-900' }}"
             fill="black" viewBox="0 0 640 640">
            <path d="M96 128C78.3 128 64 142.3 64 160C64 177.7 78.3 192 96 192L182.7 192C195 220.3 223.2 240 256 240C288.8 240 317 220.3 329.3 192L544 192C561.7 192 576 177.7 576 160C576 142.3 561.7 128 544 128L329.3 128C317 99.7 288.8 80 256 80C223.2 80 195 99.7 182.7 128L96 128zM96 288C78.3 288 64 302.3 64 320C64 337.7 78.3 352 96 352L342.7 352C355 380.3 383.2 400 416 400C448.8 400 477 380.3 489.3 352L544 352C561.7 352 576 337.7 576 320C576 302.3 561.7 288 544 288L489.3 288C477 259.7 448.8 240 416 240C383.2 240 355 259.7 342.7 288L96 288zM96 448C78.3 448 64 462.3 64 480C64 497.7 78.3 512 96 512L150.7 512C163 540.3 191.2 560 224 560C256.8 560 285 540.3 297.3 512L544 512C561.7 512 576 497.7 576 480C576 462.3 561.7 448 544 448L297.3 448C285 419.7 256.8 400 224 400C191.2 400 163 419.7 150.7 448L96 448z"/>
        </svg>
        <span class="ml-3 font-medium text-gray-700 group-hover:text-gray-900 transition-colors duration-300">
            Manage Account
        </span>
    </a>
</li>
