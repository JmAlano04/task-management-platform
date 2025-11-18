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
    <div class="flex justify-left items-center ml-10 mt-10">
        @php
            $user = Auth::user();
        @endphp
        @if($user->role === 'creator')
     
        <button 
            @click="
                modalType = 'add';
                modalTitle = 'Create New Task';
                modalAction = '{{ route('createtask.store') }}';
                showModal = true;
            "
            class="bg-gray-900 hover:bg-gray-700 text-white px-3 py-2 rounded-xl"
        >
         Create New Task
        </button>
        @endif

        @if($user->role === 'admin')
        <button 
            @click="
                modalType = 'add';
                modalTitle = 'Create New Task';
                modalAction = '{{ route('task.store') }}';
                showModal = true;
            "
               class="bg-gray-800 hover:bg-gray-700 text-white px-3 py-2 rounded-xl"
        >
            Create New Task
        </button>
        @endif

        
    </div>
    {{-- Users Table --}}
    <div class="overflow-x-auto px-8">
        <table class="min-w-96 mt-10 bg-white dark:bg-gray-700 rounded-lg shadow overflow-hidden mx-auto"> 
            <thead class="bg-white text-dark shadow-md">
                <tr>
                      @if($user->role === 'admin')
                             <th class="px-6 py-3 text-left whitespace-nowrap text-[14px]">Task#</th>
                             <th class="px-6 py-3 text-left whitespace-nowrap text-[14px]">Created By</th>
                            @endif
                            @if($user->role === 'creator')
                                <th hidden class="px-6 py-3 text-left whitespace-nowrap  text-[14px]">Task#</th>
                                <th hidden class="px-6 py-3 text-left whitespace-nowrap  text-[14px]">Created By</th>
                             @endif
                   
                    <th class="px-6 py-3 text-left whitespace-nowrapwhitespace-nowrap text-[14px]">Title</th>
                    <th class="px-6 py-3 text-left whitespace-nowrapwhitespace-nowrap text-[14px]">Assigned to</th>
                    <th class="px-6 py-3 text-left whitespace-nowrapwhitespace-nowrap text-[14px]">Description</th>
                    <th class="px-6 py-3 text-left whitespace-nowrapwhitespace-nowrap text-[14px]">Due Date</th>
                    <th class="px-6 py-3 text-left whitespace-nowrapwhitespace-nowrap text-[14px]">Status</th>
                    <th class="px-6 py-3 text-left whitespace-nowrapwhitespace-nowrap text-[14px]">Action</th>
                </tr>
            </thead>
            <tbody id="table-body" class="text-gray-800 dark:text-gray-200">
                @php
                $user = Auth::user();
                @endphp
                @include('profile.partials.table.task-management', ['task' => $task , 'taskForcreator' => $taskForcreator])
        </table>

        <div class="mt-4 flex flex-col   sm:flex-row items-center justify-center px-4 py-4 bg-gray-50 border-t rounded-md">
            {{-- <div class="text-[14px] text-gray-600">
                Showing {{ $task->firstItem() }} to {{ $task->lastItem() }} of {{ $task->total() }} task
            </div> --}}
            <div class="mt-2 sm:mt-0  ">
                {{ $task->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

   
    {{--  ADD TASK MODAL --}}
    @include("admin.template.addModalAdmin")
    {{--  EDIT TASK MODAL --}}  
    @include("admin.template.editModalAdmin")
    
    </div>

</div>

<!-- Scripts for search-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@vite(['resources/css/app.css', 'resources/js/app.js'])


</x-app-layout>
