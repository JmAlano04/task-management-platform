      {{--  ADD USER MODAL --}}
    <div 
        x-show="showModal" 
        x-transition.opacity
        class="fixed inset-0 z-70 flex items-end justify-end mr-5"
        style="display: flex;"
    >
        <div
            @click.outside="showModal = false"
            @keydown.escape.window="showModal = false"
            class="bg-white dark:bg-gray-800 rounded-md shadow-lg"
        >
        <h2 class="text-md bg-gray-200 font-semibold mb-2 p-3 text-black" x-text="modalTitle"></h2>
<template x-if="modalType === 'add'">
    
    <form method="POST" :action="modalAction" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @csrf
         <!-- Assigned To -->
        <div class="col-span-2">
            <label class="block text-gray-700 mx-2 dark:text-gray-200">Assign To</label>
            <select name="taker_id" 
                    class="w-[400px]  mx-2 p-1 text-black border rounded focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400" 
                    required>
                    <option value="">Select a user</option>
                <option value="">Select a user</option>
                @foreach($users->where('role', 'taker') as $taker)
                    <option value="{{ $taker->id }}">{{ $taker->name }}</option>
                @endforeach
            </select>
        </div>
        <!-- Title -->
        <div class="col-span-2">
            <label class="block text-gray-700 mx-2  dark:text-gray-200">Title</label>
            <input type="text" name="title" 
                   class="w-[400px] mx-2 p-1 text-black  border rounded focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400" 
                   placeholder="Enter task title" required>
        </div>

       <!-- Created by -->
    <div class="col-span-2">
        <input type="hidden" name="created_by_id" value="{{ auth()->user()->id }}">
      
    </div>


        <!-- Due Date -->
        <div class="col-span-2">
            <label class="block text-gray-700 mx-2  dark:text-gray-200">Due Date</label>
            <input type="date" name="due_date" 
                   class="w-[400px] mx-2 p-1 text-black  border rounded focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400" 
                   required>
        </div>

        <!-- Status -->
        <div class="col-span-2">
            <label class="block text-gray-700 mx-2 dark:text-gray-200">Status</label>
            <select name="status" 
                    class="w-[400px] mx-2 p-1 text-black  border rounded focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400" 
                    required>
                <option value="pending">Pending</option>
                <option value="in_progress">In Progress</option>
                <option value="completed">Completed</option>
            </select>
        </div>

         <!-- Description -->
        <div class="col-span-2">
            <label class="block text-gray-700 mx-2 dark:text-gray-200">Description</label>
            <textarea name="description" rows="3" 
                      class="w-[400px] mx-2 p-1 text-black  border rounded focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400" 
                      placeholder="Enter task description" required></textarea>
        </div>
        <!-- Buttons -->
        <div class="col-span-2 flex justify-end mt-1">
            <button type="button" @click="showModal = false" class="mr-2 mb-3 px-3 py-2 rounded-md bg-gray-300 text-black hover:bg-gray-400">Cancel</button>
            <button type="submit" class=" mb-3 px-3 py-2 rounded-md bg-gray-800 text-white hover:bg-gray-600">Save Task</button>
        </div>
    </form>
</template>


        </div>
    </div>