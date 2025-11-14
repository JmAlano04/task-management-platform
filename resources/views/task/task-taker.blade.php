<x-app-layout title="My Tasks">

    <div class="p-6">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">My Tasks</h1>

        <!-- Kanban Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 h-[80vh]">

            <!-- ============================= -->
            <!--        PENDING COLUMN         -->
            <!-- ============================= -->
            <div class="bg-gray-50 rounded-xl p-4 overflow-y-auto shadow-inner">
                <h2 class="text-xl font-bold mb-4 text-yellow-600">Pending</h2>

                @foreach ($tasks->where('status', 'pending') as $task)
                    <div class="bg-white rounded-xl shadow-md p-4 mb-4 border-l-4 border-yellow-400 hover:shadow-lg transition">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $task->title }}</h3>
                        <p class="text-gray-500 mt-1 text-sm">{{ $task->description }}</p>

                        <div class="mt-2 text-xs text-gray-600">
                            <p><strong>Creator:</strong> {{ $task->creator->name }}</p>
                            <p><strong>Due:</strong> {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'No Deadline' }}</p>
                        </div>

                        <div class="mt-3 flex justify-between items-center">
                            <span class="bg-yellow-200 text-yellow-700 px-2 py-1 rounded-full text-xs font-medium">
                                Pending
                            </span>

                            <form action="{{ route('tasks.start', $task->id) }}" method="POST">
                                @csrf
                                <button class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded text-xs">
                                    Start
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- ============================= -->
            <!--     IN PROGRESS COLUMN        -->
            <!-- ============================= -->
            <div class="bg-gray-50 rounded-xl p-4 overflow-y-auto shadow-inner">
                <h2 class="text-xl font-bold mb-4 text-blue-600">In Progress</h2>

                @foreach ($tasks->where('status', 'in_progress') as $task)
                    <div class="bg-white rounded-xl shadow-md p-4 mb-4 border-l-4 border-blue-400 hover:shadow-lg transition">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $task->title }}</h3>
                        <p class="text-gray-500 mt-1 text-sm">{{ $task->description }}</p>

                        <div class="mt-2 text-xs text-gray-600">
                            <p><strong>Creator:</strong> {{ $task->creator->name }}</p>
                            <p><strong>Due:</strong> {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'No Deadline' }}</p>
                        </div>

                        <div class="mt-3 flex justify-between items-center">
                            <span class="bg-blue-200 text-blue-700 px-2 py-1 rounded-full text-xs font-medium">
                                In Progress
                            </span>

                            <form action="{{ route('tasks.complete', $task->id) }}" method="POST">
                                @csrf
                                <button class="bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded text-xs">
                                    Complete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- ============================= -->
            <!--        COMPLETED COLUMN       -->
            <!-- ============================= -->
            <div class="bg-gray-50 rounded-xl p-4 overflow-y-auto shadow-inner">
                <h2 class="text-xl font-bold mb-4 text-green-600">Completed</h2>

                @foreach ($tasks->where('status', 'completed') as $task)
                    <div class="bg-white rounded-xl shadow-md p-4 mb-4 border-l-4 border-green-400 hover:shadow-lg transition">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $task->title }}</h3>
                        <p class="text-gray-500 mt-1 text-sm">{{ $task->description }}</p>

                        <div class="mt-2 text-xs text-gray-600">
                            <p><strong>Creator:</strong> {{ $task->creator->name }}</p>
                            <p><strong>Completed:</strong> {{ $task->updated_at->format('M d, Y') }}</p>
                        </div>

                        <div class="mt-3">
                            <span class="bg-green-200 text-green-700 px-2 py-1 rounded-full text-xs font-medium">
                                Completed
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

</x-app-layout>
