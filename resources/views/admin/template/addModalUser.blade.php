 {{-- add User Modal --}}
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
                    <div class="col-span-2">
                        <label class="block text-gray-700 dark:text-gray-200">Name</label>
                        <input type="text" name="name" class="w-full px-3 py-2 border rounded" placeholder="Enter Fullname" required>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-gray-700 dark:text-gray-200">Email</label>
                        <input type="email" name="email" class="w-full px-3 py-2 border rounded" placeholder="Enter Email" required>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-gray-700 dark:text-gray-200">Role</label>
                        <select name="role" class="w-full px-3 py-2 border rounded" required>
                            <option value="admin">Admin</option>
                            <option value="creator">Creator</option>
                            <option value="taker">Taker</option>
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-gray-700 dark:text-gray-200">Password</label>
                        <input type="text" name="password" value="password" class="w-full px-3 py-2 border rounded" required>
                        <small class="text-gray-500">Default password is <strong>password</strong>.</small>
                    </div>

                    <div class="col-span-2 flex justify-end mt-4">
                        <button type="button" @click="showModal = false" class="mr-2 px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Cancel</button>
                        <button type="submit" class="px-4 py-2 rounded bg-gray-800 text-white hover:bg-gray-600">Save</button>
                    </div>
                </form>
            </template>
        </div>
    </div>