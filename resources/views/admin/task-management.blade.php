<x-app-layout title="Task Management">
<div 
    x-data="{ 
        showModal: false, 
        showEdit: false, 
        modalType: '', 
        modalTitle: '', 
        modalAction: '', 
        modalData: { name: '', email: '', role: '' },
        flashMessage: '', 
        flashType: '', 
        showFlash: false 
    }"
    x-init="
        @if(session('success'))
            flashMessage = '{{ session('success') }}';
            flashType = 'success';
            showFlash = true;
            setTimeout(() => showFlash = false, 3000);
        @elseif(session('error'))
            flashMessage = '{{ session('error') }}';
            flashType = 'error';
            showFlash = true;
            setTimeout(() => showFlash = false, 3000);
        @elseif($errors->any())
            flashMessage = '{{ implode(' | ', $errors->all()) }}';
            flashType = 'error';
            showFlash = true;
            setTimeout(() => showFlash = false, 3000);
        @endif
    "
>

    {{-- Flash Message --}}
    <div 
        x-show="showFlash" 
        x-transition
        class="fixed top-6 right-6 z-50 px-4 py-2 rounded shadow"
        :class="flashType === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'"
        style="display: none;"
    >
        <p x-text="flashMessage"></p>
    </div>

    {{-- Header --}}
    <div class="flex justify-between items-center mt-20 mb-6">
        @php
            $user = Auth::user();
        @endphp
        @if($user->role === 'creator')
        <h2 class="text-2xl font-semibold ml-10 text-gray-800 dark:text-gray-200">Create Management</h2>
          <input 
                type="text"
                id="search"
                placeholder="Search..."
                data-url="{{ route('task-management.search') }}"
                class="w-96 border border-gray-300 rounded-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent" />
        
        <button 
            @click="
                modalType = 'add';
                modalTitle = 'Create New Task';
                modalAction = '{{ route('createtask.store') }}';
                showModal = true;
            "
            class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded shadow mr-10"
        >
         Create New Task
        </button>
        @endif
        @if($user->role === 'admin')
         <h2 class="text-2xl font-semibold ml-10 text-gray-800 dark:text-gray-200">Task Management</h2>
        
        <input 
                type="text"
                id="search"
                placeholder="Search..."
                data-url="{{ route('task-management.search') }}"
                class="w-96 border border-gray-300 rounded-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent" />
        

        {{-- <input type="text" wire:model.live="search" placeholder="Search tasks..." class="form-control"> --}}

        <button 
            @click="
                modalType = 'add';
                modalTitle = 'Create New Task';
                modalAction = '{{ route('task.store') }}';
                showModal = true;
            "
            class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded shadow mr-10"
        >
        
            Create New Task
        </button>
        @endif

        
    </div>

    {{-- Users Table --}}
    <div class="overflow-x-auto px-8">
        <table class="min-w-[1200px] bg-white dark:bg-gray-700 rounded-lg shadow overflow-hidden mx-auto"> 
            <thead class="bg-white text-dark shadow-md">
                <tr>
                      @if($user->role === 'admin')
                             <th class="px-6 py-3 text-left">Task#</th>
                             <th class="px-6 py-3 text-left">Created By</th>
                            @endif
                            @if($user->role === 'creator')
                                <th hidden class="px-6 py-3 text-left">Task#</th>
                                <th hidden class="px-6 py-3 text-left">Created By</th>
                             @endif
                   
                    <th class="px-6 py-3 text-left">Title</th>
                    <th class="px-6 py-3 text-left">Assigned To</th>
                    <th class="px-6 py-3 text-left">Description</th>
                    <th class="px-6 py-3 text-left">Due Date</th>
                    <th class="px-6 py-3 text-left">Status</th>
                    <th class="px-6 py-3 text-left">Action</th>
                </tr>
            </thead>
            <tbody id="table-body" class="text-gray-800 dark:text-gray-200">
                @php
                $user = Auth::user();
                @endphp
           @if($user->role === 'admin')
                @include('profile.partials.table.task-management', ['task' => $task])
            @endif

            @if($user->role === 'creator')
                @include('profile.partials.table.creator-management', [ 'taskForcreator' => $taskForcreator])
            @endif

        </table>

     

        <div class="mt-4 flex flex-col sm:flex-row items-center justify-between px-4 py-4 bg-gray-50 border-t rounded-md">
            <div class="text-sm text-gray-600">
                Showing {{ $task->firstItem() }} to {{ $task->lastItem() }} of {{ $task->total() }} task
            </div>
            <div class="mt-2 sm:mt-0">
                {{ $task->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    {{--  ADD USER MODAL --}}
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
<template x-if="modalType === 'add'">
    <form method="POST" :action="modalAction" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @csrf

        <!-- Title -->
        <div class="col-span-2">
            <label class="block text-gray-700 dark:text-gray-200">Title</label>
            <input type="text" name="title" 
                   class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400" 
                   placeholder="Enter task title" required>
        </div>

        <!-- Description -->
        <div class="col-span-2">
            <label class="block text-gray-700 dark:text-gray-200">Description</label>
            <textarea name="description" rows="3" 
                      class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400" 
                      placeholder="Enter task description" required></textarea>
        </div>

        <!-- Assigned To -->
        <div class="col-span-2">
            <label class="block text-gray-700 dark:text-gray-200">Assign To</label>
            <select name="taker_id" 
                    class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400" 
                    required>
                <option value="">Select a user</option>
                @foreach($users->where('role', 'taker') as $taker)
                    <option value="{{ $taker->id }}">{{ $taker->name }}</option>
                @endforeach
            </select>
        </div>


       <!-- Created by -->
    <div class="col-span-2">
        <input type="hidden" name="created_by_id" value="{{ auth()->user()->id }}">
      
    </div>


        <!-- Due Date -->
        <div class="col-span-2">
            <label class="block text-gray-700 dark:text-gray-200">Due Date</label>
            <input type="date" name="due_date" 
                   class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400" 
                   required>
        </div>

        <!-- Status -->
        <div class="col-span-2">
            <label class="block text-gray-700 dark:text-gray-200">Status</label>
            <select name="status" 
                    class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400" 
                    required>
                <option value="pending">Pending</option>
                <option value="in_progress">In Progress</option>
                <option value="completed">Completed</option>
            </select>
        </div>

        <!-- Buttons -->
        <div class="col-span-2 flex justify-end mt-4">
            <button type="button" @click="showModal = false" class="mr-2 px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Cancel</button>
            <button type="submit" class="px-4 py-2 rounded bg-gray-800 text-white hover:bg-gray-600">Save Task</button>
        </div>
    </form>
</template>


        </div>
    </div>
{{--  EDIT USER MODAL --}}
<div  
    x-show="showEdit" 
    x-transition.opacity
    class="fixed inset-0 z-50 bg-black/30 backdrop-blur-sm flex items-center justify-center"
    style="display: none;"
>
    <div
        @click.outside="showEdit = false"
        @keydown.escape.window="showEdit = false"
        class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-[700px] p-8"
    >
    <template x-if="modalType === 'Edit'">
    <form 
        method="POST" 
        :action="modalAction" 
        class="grid grid-cols-1 md:grid-cols-2 gap-4"
    >
        @csrf
        @method('PUT')

        <h2 class="text-lg font-semibold mb-4 col-span-2" x-text="modalTitle"></h2>

        <!-- Title -->
        <div class="col-span-2">
            <label class="block text-gray-700 dark:text-gray-200">Title</label>
            <input 
                type="text" 
                name="title" 
                x-model="modalData.title"
                class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400"
                placeholder="Enter task title"
                required
            >
        </div>

        <!-- Description -->
        <div class="col-span-2">
            <label class="block text-gray-700 dark:text-gray-200">Description</label>
            <textarea 
                name="description" 
                rows="3" 
                x-model="modalData.description"
                class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400"
                placeholder="Enter task description"
                required
            ></textarea>
        </div>

        <!-- Assigned To -->
<div class="col-span-2">
    <label class="block text-gray-700 dark:text-gray-200">Assign To</label>
    <select 
        name="taker_id" 
        x-model="modalData.taker_id"
        class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400"
        required
    >
        <option value="">Select a user</option>
        @foreach($users->where('role', 'taker') as $taker)
            <option value="{{ $taker->id }}" :selected="modalData.taker_id == {{ $taker->id }}">
                {{ $taker->name }}
            </option>
        @endforeach
    </select>
</div>

<!-- Created By -->
<div class="col-span-2">
        <input type="hidden" type="hidden"
        name="created_by_id" 
        x-model="modalData.created_by_id" name="created_by_id" value="{{ auth()->user()->id }}">
      
    </div>
</div>


        <!-- Due Date -->
        <div class="col-span-2">
            <label class="block text-gray-700 dark:text-gray-200">Due Date</label>
            <input 
                type="date" 
                name="due_date" 
                x-model="modalData.due_date"
                class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400"
                required
            >
        </div>

        <!-- Status -->
        <div class="col-span-2">
            <label class="block text-gray-700 dark:text-gray-200">Status</label>
            <select 
                name="status" 
                x-model="modalData.status"
                class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400"
                required
            >
                <option value="pending" :selected="modalData.status == 'pending'">Pending</option>
                <option value="in_progress" :selected="modalData.status == 'in_progress'">In Progress</option>
                <option value="completed" :selected="modalData.status == 'completed'">Completed</option>
            </select>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end col-span-2 mt-4">
            <button 
                type="button" 
                @click="showEdit = false" 
                class="mr-2 px-4 py-2 rounded bg-gray-300 hover:bg-gray-400"
            >
                Cancel
            </button>
            <button 
                type="submit" 
                class="px-4 py-2 rounded bg-gray-800 text-white hover:bg-gray-600"
            >
                Update Task
            </button>
        </div>
    </form>
</template>


    </div>
</div>

    </div>

</div>

<!-- Scripts for search-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@vite(['resources/css/app.css', 'resources/js/app.js'])


</x-app-layout>
