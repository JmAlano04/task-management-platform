

<!-- Include Lucide Icons CDN (only once in your head section) -->
<script src="https://unpkg.com/lucide@latest"></script>

<h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Dashboard</h1>

<!-- Stats Section -->
<div class="grid grid-cols-1 sm:grid-cols-4 gap-6 mt-6">

    <!-- Total Assigned Tasks -->
    <div class="bg-indigo-50 dark:bg-gray-700 p-6 rounded-lg shadow flex items-center justify-between">
        <div>
            <h4 class="text-lg font-semibold text-indigo-700 dark:text-indigo-400">Total Tasks</h4>
            {{-- <p class="text-3xl font-bold mt-2 text-gray-900 dark:text-white">{{ $totalAssigned }}</p> --}}
        </div>
        <i data-lucide="clipboard-list" class="w-10 h-10 text-indigo-600 dark:text-indigo-300"></i>
    </div>

    <!-- Tasks In Progress -->
    <div class="bg-yellow-50 dark:bg-gray-700 p-6 rounded-lg shadow flex items-center justify-between">
        <div>
            <h4 class="text-lg font-semibold text-yellow-700 dark:text-yellow-400">In Progress</h4>
            {{-- <p class="text-3xl font-bold mt-2 text-gray-900 dark:text-white">{{ $totalInProgress }}</p> --}}
        </div>
        <i data-lucide="refresh-cw" class="w-10 h-10 text-yellow-600 dark:text-yellow-300"></i>
    </div>

    <!-- Completed -->
    <div class="bg-green-50 dark:bg-gray-700 p-6 rounded-lg shadow flex items-center justify-between">
        <div>
            <h4 class="text-lg font-semibold text-green-700 dark:text-green-400">Completed</h4>
            {{-- <p class="text-3xl font-bold mt-2 text-gray-900 dark:text-white">{{ $totalCompleted }}</p> --}}
        </div>
        <i data-lucide="check-circle" class="w-10 h-10 text-green-600 dark:text-green-300"></i>
    </div>

    <!-- Pending -->
    <div class="bg-pink-50 dark:bg-gray-700 p-6 rounded-lg shadow flex items-center justify-between">
        <div>
            <h4 class="text-lg font-semibold text-pink-700 dark:text-pink-400">Pending</h4>
            <p class="text-3xl font-bold mt-2 text-gray-900 dark:text-white">{{ $totalPending }}</p>
        </div>
        <i data-lucide="clock" class="w-10 h-10 text-pink-600 dark:text-pink-300"></i>
    </div>

</div>

<script>
    lucide.createIcons();
</script>

<!-- Task Table -->
<div class="bg-white dark:bg-gray-900 rounded-lg shadow mt-10 overflow-hidden">
    <div class="px-6 py-4 border-b dark:border-gray-700 flex justify-between items-center">
        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">My Assigned Tasks</h4>
    </div>

    {{-- <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-100 dark:bg-gray-800">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Task</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created By</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>

            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($tasks as $task)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $task->title }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $task->creator?->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $task->status === 'completed' ? 'bg-green-100 text-green-800' : ($task->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : 'bg-pink-100 text-pink-800') }}">
                            {{ ucfirst($task->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">{{ $task->description }}</td>
                    <td class="px-6 py-4">
                        @if($task->status != 'completed')
                        <form method="POST" action="{{ route('tasks.updateStatus', $task->id) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="completed">
                            <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">
                                Mark Completed
                            </button>
                        </form>
                        @else
                        <span class="text-gray-500">Done</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4 flex flex-col sm:flex-row items-center justify-between px-4 py-4 bg-gray-50 border-t rounded-md">
            <div class="text-sm text-gray-600">
                Showing {{ $tasks->firstItem() }} to {{ $tasks->lastItem() }} of {{ $tasks->total() }} Tasks
            </div>
            <div class="mt-2 sm:mt-0">
                {{ $tasks->appends(request()->query())->links() }}
            </div>
        </div> --}}
    </div>
</div>

