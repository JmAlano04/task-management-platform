<x-app-layout title="My Tasks">
<div 
    x-data="{ 
        showModal: false, 
        modalType: '', 
        modalTitle: '', 
        modalAction: '', 
        modalTask: {},
        flashMessage: '', 
        flashType: '', 
        showFlash: false 
    }"
>
    <div class="p-6">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">My Tasks</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 h-[80vh]">

            <!-- PENDING COLUMN -->
            <div class="bg-gray-50 rounded-xl p-4 overflow-y-auto shadow-inner">
                <h2 class="text-xl font-bold mb-4 text-yellow-600">Pending</h2>

                @foreach ($tasks->where('status', 'pending')->sortBy('created_at') as $task)
                    <div class="bg-white rounded-xl shadow-md p-4 mb-4 border-l-4 border-yellow-400 hover:shadow-lg transition">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $task->title }}</h3>
                        <p class="text-gray-500 mt-1 text-sm">{{ $task->description }}</p>

                        <div class="mt-2 text-xs text-gray-600">
                            <p><strong>Creator:</strong> {{ $task->creator->name }}</p>
                            <p><strong>Due:</strong> {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'No Deadline' }}</p>
                        </div>

                        <div class="mt-3 flex justify-between items-center">
                            <span class="bg-yellow-200 text-yellow-700 px-2 py-1 rounded-full text-xs font-medium">Pending</span>
                            <button
                                @click="
                                    modalType = 'Start';
                                    modalTitle = 'Start Task';
                                    modalAction = '{{ route('tasks.start', $task->id) }}';
                                    modalTask = {{ Js::from($task) }};
                                    showModal = true;
                                "
                                class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded text-xs"
                            >
                                Start
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- IN PROGRESS COLUMN -->
            <div class="bg-gray-50 rounded-xl p-4 overflow-y-auto shadow-inner">
                <h2 class="text-xl font-bold mb-4 text-blue-600">In Progress</h2>

                @foreach ($tasks->where('status', 'in_progress')->sortBy('created_at') as $task)
                    <div class="bg-white rounded-xl shadow-md p-4 mb-4 border-l-4 border-blue-400 hover:shadow-lg transition">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $task->title }}</h3>
                        <p class="text-gray-500 mt-1 text-sm">{{ $task->description }}</p>

                        <div class="mt-2 text-xs text-gray-600">
                            <p><strong>Creator:</strong> {{ $task->creator->name }}</p>
                            <p><strong>Due:</strong> {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'No Deadline' }}</p>
                        </div>

                        <div class="mt-3 flex justify-between items-center">
                            <span class="bg-blue-200 text-blue-700 px-2 py-1 rounded-full text-xs font-medium">In Progress</span>
                            <button
                                @click="
                                    modalType = 'Complete';
                                    modalTitle = 'Complete Task';
                                    modalAction = '{{ route('tasks.complete', $task->id) }}';
                                    modalTask = {{ Js::from($task) }};
                                    showModal = true;
                                "
                                class="bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded text-xs"
                            >
                                Complete
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- COMPLETED COLUMN -->
            <div class="bg-gray-50 rounded-xl p-4 overflow-y-auto shadow-inner">
                <h2 class="text-xl font-bold mb-4 text-green-600">Completed</h2>

                @foreach ($tasks->where('status', 'completed')->sortBy('id') as $task)
                    <div class="bg-white rounded-xl shadow-md p-4 mb-4 border-l-4 border-green-400 hover:shadow-lg transition">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $task->title }}</h3>
                        <p class="text-gray-500 mt-1 text-sm">{{ $task->description }}</p>

                        <div class="mt-2 text-xs text-gray-600">
                            <p><strong>Creator:</strong> {{ $task->creator->name }}</p>
                            <p><strong>Completed:</strong> {{ $task->updated_at->format('M d, Y') }}</p>
                        </div>

                        <div class="mt-3">
                            <span class="bg-green-200 text-green-700 px-2 py-1 rounded-full text-xs font-medium">Completed</span>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        <!-- MODAL CONTAINER -->
        <div 
            x-show="showModal"
            x-transition.opacity
            class="fixed inset-0 z-50 bg-black/30 backdrop-blur-sm flex items-center justify-center"
            style="display: none;"
        >
            <div
                @click.outside="showModal = false"
                @keydown.escape.window="showModal = false"
                class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-[700px] p-8"
            >
                <h2 class="text-lg font-semibold mb-4" x-text="modalTitle"></h2>

                <!-- START TASK MODAL -->
                <template x-if="modalType === 'Start'">
                    <form method="POST" :action="modalAction" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @csrf
                        <div class="col-span-2">
                            <p class="text-gray-600">Are you sure you want to start this task?</p>
                            <p class="mt-2 text-sm text-gray-500" x-text="modalTask.title"></p>
                        </div>

                        <div class="col-span-2 flex justify-end mt-4">
                            <button type="button" @click="showModal = false" class="mr-2 px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Cancel</button>
                            <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Start Task</button>
                        </div>
                    </form>
                </template>

                <!-- COMPLETE TASK MODAL -->
                <template x-if="modalType === 'Complete'">
                    <form method="POST" :action="modalAction" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @csrf
                        <div class="col-span-2">
                            <p class="text-gray-600">Mark As Completed</p>
                            <p class="mt-2 text-sm text-gray-500" x-text="modalTask.title"></p>
                        </div>

                        <div class="col-span-2 flex justify-end mt-4">
                            <button type="button" @click="showModal = false" class="mr-2 px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Cancel</button>
                            <button type="submit" class="px-4 py-2 rounded bg-green-600 text-white hover:bg-green-700">Complete Task</button>
                        </div>
                    </form>
                </template>

            </div>
        </div>

    </div>
</div>
</x-app-layout>
