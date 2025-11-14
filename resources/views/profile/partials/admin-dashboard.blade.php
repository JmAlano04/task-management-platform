<!-- Include Lucide Icons CDN (add this once in your <head> section) -->
<script src="https://unpkg.com/lucide@latest"></script>

@php
    $user = Auth::user();
@endphp

@if($user->role === 'admin')
    <h1 class="text-2xl font-bold">Dashboard</h1>

    <!-- Stats Section -->
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 mt-6">
        <!-- Total Tasks -->
        <div class="bg-pink-50 dark:bg-gray-700 p-6 rounded-lg shadow flex items-center justify-between">
            <div>
                <h4 class="text-lg font-semibold text-pink-700 dark:text-pink-400">Total Tasks</h4>
                <p class="text-3xl font-bold mt-2 text-gray-900 dark:text-white">{{ $totalTask }}</p>
            </div>
            <i data-lucide="list-checks" class="w-10 h-10 text-pink-600 dark:text-pink-300"></i>
        </div>

        <!-- Completed -->
        <div class="bg-green-50 dark:bg-gray-700 p-6 rounded-lg shadow flex items-center justify-between">
            <div>
                <h4 class="text-lg font-semibold text-green-700 dark:text-green-400">Completed</h4>
                <p class="text-3xl font-bold mt-2 text-gray-900 dark:text-white">{{ $totalCompleted }}</p>
            </div>
            <i data-lucide="check-circle" class="w-10 h-10 text-green-600 dark:text-green-300"></i>
        </div>

        <!-- Pending -->
        <div class="bg-yellow-50 dark:bg-gray-700 p-6 rounded-lg shadow flex items-center justify-between">
            <div>
                <h4 class="text-lg font-semibold text-yellow-700 dark:text-yellow-400">Pending</h4>
                <p class="text-3xl font-bold mt-2 text-gray-900 dark:text-white">{{ $totalPending }}</p>
            </div>
            <i data-lucide="clock" class="w-10 h-10 text-yellow-600 dark:text-yellow-300"></i>
        </div>

        <!-- In Progress -->
        <div class="bg-indigo-50 dark:bg-gray-700 p-6 rounded-lg shadow flex items-center justify-between">
            <div>
                <h4 class="text-lg font-semibold text-indigo-700 dark:text-indigo-400">In Progress</h4>
                <p class="text-3xl font-bold mt-2 text-gray-900 dark:text-white">{{ $totalIn_progress }}</p>
            </div>
            <i data-lucide="refresh-cw" class="w-10 h-10 text-indigo-600 dark:text-indigo-300"></i>
        </div>
    </div>
@endif

@if($user->role === 'creator')
    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Task Creator Dashboard</h1>

    <!-- Top Stats Section -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mt-6">
        <!-- Tasks Assigned to Me -->
        <div class="bg-purple-50 dark:bg-gray-700 p-6 rounded-lg shadow flex flex-col justify-between">
            <div>
                <h4 class="text-lg font-semibold text-purple-700 dark:text-purple-400">Total Tasks</h4>
                <p class="text-3xl font-bold mt-2 text-gray-900 dark:text-white">{{ $totalTask }}</p>
            </div>
            <i data-lucide="user-check" class="w-8 h-8 mt-4 text-purple-600 dark:text-purple-300"></i>
        </div>

        <!-- Tasks Assigned to Others -->
        <div class="bg-teal-50 dark:bg-gray-700 p-6 rounded-lg shadow flex flex-col justify-between">
            <div>
                <h4 class="text-lg font-semibold text-teal-700 dark:text-teal-400">Assigned Tasks</h4>
                <p class="text-3xl font-bold mt-2 text-gray-900 dark:text-white">
                    {{ $assignedTaskCount }}
                </p>
            </div>
            <i data-lucide="users" class="w-8 h-8 mt-4 text-teal-600 dark:text-teal-300"></i>
        </div>

        <!-- Overdue Tasks -->
        <div class="bg-red-50 dark:bg-gray-700 p-6 rounded-lg shadow flex flex-col justify-between">
            <div>
                <h4 class="text-lg font-semibold text-red-700 dark:text-red-400">Overdue Tasks</h4>
                <p class="text-3xl font-bold mt-2 text-gray-900 dark:text-white">{{ $overdueCount }}</p>
            </div>
            <i data-lucide="alert-triangle" class="w-8 h-8 mt-4 text-red-600 dark:text-red-300"></i>
        </div>
    </div>
@endif

@if($user->role === 'taker')
    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Task Taker Dashboard</h1>

<!-- Stats Section -->
<div class="grid grid-cols-1 sm:grid-cols-4 gap-6 mt-6">

    <!-- Total Assigned Tasks -->
    <div class="bg-indigo-50 dark:bg-gray-700 p-6 rounded-lg shadow flex items-center justify-between">
        <div>
            <h4 class="text-lg font-semibold text-indigo-700 dark:text-indigo-400">Total Tasks</h4>
            <p class="text-3xl font-bold mt-2 text-gray-900 dark:text-white">{{ $takerCount }}</p>
        </div>
        <i data-lucide="clipboard-list" class="w-10 h-10 text-indigo-600 dark:text-indigo-300"></i>
    </div>

    <!-- Tasks In Progress -->
    <div class="bg-yellow-50 dark:bg-gray-700 p-6 rounded-lg shadow flex items-center justify-between">
        <div>
            <h4 class="text-lg font-semibold text-yellow-700 dark:text-yellow-400">In Progress</h4>
            <p class="text-3xl font-bold mt-2 text-gray-900 dark:text-white">{{  $takerInProgress }}</p>
        </div>
        <i data-lucide="refresh-cw" class="w-10 h-10 text-yellow-600 dark:text-yellow-300"></i>
    </div>

    <!-- Completed -->
    <div class="bg-green-50 dark:bg-gray-700 p-6 rounded-lg shadow flex items-center justify-between">
        <div>
            <h4 class="text-lg font-semibold text-green-700 dark:text-green-400">Completed</h4>
            <p class="text-3xl font-bold mt-2 text-gray-900 dark:text-white">{{ $totalCompleted }}</p>
        </div>
        <i data-lucide="check-circle" class="w-10 h-10 text-green-600 dark:text-green-300"></i>
    </div>

    <!-- Pending -->
    <div class="bg-pink-50 dark:bg-gray-700 p-6 rounded-lg shadow flex items-center justify-between">
        <div>
            <h4 class="text-lg font-semibold text-pink-700 dark:text-pink-400">Pending</h4>
            <p class="text-3xl font-bold mt-2 text-gray-900 dark:text-white">{{ $takerPending}}</p>
        </div>
        <i data-lucide="clock" class="w-10 h-10 text-pink-600 dark:text-pink-300"></i>
    </div>

</div>

        
<!-- Task Management Table -->
<div class="bg-white dark:bg-gray-900 rounded-lg shadow mt-10 overflow-hidden">
    <div class="px-6 py-4 border-b dark:border-gray-700 flex justify-between items-center">
        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Pending Tasks</h4>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-100 dark:bg-gray-800">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Task</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assigned To</th>
                     <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created By</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($tasktaker as $tasktakers)
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{$tasktakers->id }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                            {{ $tasktakers->taker?->name ?? 'Unassigned' }}
                        </td>
                         <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                            {{ $tasktakers->creator?->name ?? 'Unassigned' }}
                        <td class="px-6 py-4">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $tasktakers->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($tasktakers->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            {{ $tasktakers->description }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@else
<!-- Task Management Table -->
<div class="bg-white dark:bg-gray-900 rounded-lg shadow mt-10 overflow-hidden">
    <div class="px-6 py-4 border-b dark:border-gray-700 flex justify-between items-center">
        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">In Progress Tasks</h4>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-100 dark:bg-gray-800">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Task</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assigned To</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($tasks as $task)
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $task->id }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                            {{ $task->taker?->name ?? 'Unassigned' }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $task->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($task->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            {{ $task->description }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endif

<!-- Initialize Lucide Icons -->
<script>
    lucide.createIcons();
</script>

