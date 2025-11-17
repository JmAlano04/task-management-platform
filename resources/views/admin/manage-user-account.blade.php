<x-app-layout title="Manage Users Account">
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
    <h2 class="text-2xl font-semibold ml-10 text-gray-800 dark:text-gray-200">Manage Users Account</h2>

    <div class="flex items-center gap-4 mr-10">
        {{-- Role Filter Form --}}
        <form method="GET" action="{{ route('manage.index') }}" class="flex items-center gap-4">
            <div class="relative">
                <select name="role" 
                        class="appearance-none w-full px-3 py-2 border rounded focus:ring-2 focus:ring-pink-500 pr-8 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                    <option value="">All Roles</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="creator" {{ request('role') == 'creator' ? 'selected' : '' }}>Creator</option>
                    <option value="taker" {{ request('role') == 'taker' ? 'selected' : '' }}>Taker</option>
                </select>
               
            </div>
            <button type="submit" class="px-3 py-2 rounded bg-gray-800 text-white hover:bg-gray-900">Filter</button>
        </form>

        {{-- Add User Button --}}
        <button 
            @click="
                modalType = 'add';
                modalTitle = 'Add New User';
                modalAction = '{{ route('users.store') }}';
                showModal = true;
            "
            class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded shadow"
        >
            + Add User
        </button>
    </div>
</div>


    {{-- Users Table --}}
    <div class="overflow-x-auto px-8">
        <table class="min-w-[1200px] bg-white dark:bg-gray-700 rounded-lg shadow overflow-hidden mx-auto"> 
            <thead class="bg-white text-dark shadow-md">
                <tr>
                    <th class="px-6 py-3 text-left">#</th>
                    <th class="px-6 py-3 text-left">Name</th>
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-left">Role</th>
                    <th class="px-6 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody id="table-body" class="text-gray-800 dark:text-gray-200">
                @include('profile.partials.table.manage-account', ['users' => $users])
            </tbody>
        </table>

       
        <div class="mt-4 flex flex-col sm:flex-row items-center justify-between px-4 py-4 bg-gray-50 border-t rounded-md">
            <div class="text-sm text-gray-600">
                Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} Users
            </div>
            <div class="mt-2 sm:mt-0">
                {{ $users->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    {{--  add User Modal --}}
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

    </div>

</div>

<!-- Scripts for search-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@vite(['resources/css/app.css', 'resources/js/app.js'])

</x-app-layout>
