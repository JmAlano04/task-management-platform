   
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

                <div class="col-span-2">
                    <label class="block text-gray-700 dark:text-gray-200">Name</label>
                    <input 
                        type="text" 
                        name="name" 
                        x-model="modalData.name"
                        class="w-full px-3 py-2 border rounded focus:ring-pink-500 focus:border-pink-500"
                        required
                    >
                </div>

                <div class="col-span-2">
                    <label class="block text-gray-700 dark:text-gray-200">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        x-model="modalData.email"
                        class="w-full px-3 py-2 border rounded focus:ring-pink-500 focus:border-pink-500"
                        required
                    >
                </div>

                <div class="col-span-2">
                    <label class="block text-gray-700 dark:text-gray-200">Role</label>
                    <select 
                        name="role" 
                        x-model="modalData.role"
                        class="w-full px-3 py-2 border rounded focus:ring-pink-500 focus:border-pink-500"
                        required
                    >
                        <option value="admin">Admin</option>
                        <option value="creator">Creator</option>
                        <option value="taker">Taker</option>
                    </select>
                </div>

                <div class="col-span-2">
                    <label class="block text-gray-700 dark:text-gray-200">Password (optional)</label>
                    <input 
                        type="password" 
                        name="password"
                        class="w-full px-3 py-2 border rounded focus:ring-pink-500 focus:border-pink-500"
                        placeholder="Leave blank to keep current password"
                    >
                </div>

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
                        Update
                    </button>
                </div>
            </form>
        </template>
    </div>
</div>
