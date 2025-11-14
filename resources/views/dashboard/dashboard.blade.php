<x-app-layout title="Dashboard">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                   @if(Auth::user()->role === 'admin')
                        @include('profile.partials.admin-dashboard')
                    @elseif(Auth::user()->role === 'creator')
                        @include('profile.partials.admin-dashboard')
                    @else
                        @include('profile.partials.admin-dashboard')
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
