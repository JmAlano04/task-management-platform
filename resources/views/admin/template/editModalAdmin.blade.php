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
                class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400"
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
                class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400"
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
        class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400"
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
                class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400"
                required
            >
        </div>

        <!-- Status -->
        <div class="col-span-2">
            <label class="block text-gray-700 dark:text-gray-200">Status</label>
            <select 
                name="status" 
                x-model="modalData.status"
                class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400"
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