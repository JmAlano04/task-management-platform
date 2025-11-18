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
      {{-- Role Filter Form --}}
        <form method="GET" action="{{ route('manage.index') }}" class="flex ml-10 items-center gap-4 ">
            <div class="relative">
                <select name="role" 
                        class="appearance-none w-full px-3 py-2 border rounded focus:ring-2 focus:ring-gray-500 pr-8 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                    <option value="">All Roles</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="creator" {{ request('role') == 'creator' ? 'selected' : '' }}>Creator</option>
                    <option value="taker" {{ request('role') == 'taker' ? 'selected' : '' }}>Taker</option>
                </select>
               
            </div>
            <button type="submit" class="px-3 py-2 rounded bg-gray-800 text-white hover:bg-gray-900">Filter</button>
        </form>

    <div class="flex items-center gap-4 mr-10 ">
      

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
        <table class="min-w-[1050px] bg-white dark:bg-gray-700 rounded-lg shadow overflow-hidden mx-auto"> 
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

       
        <div class="mt-4 flex flex-col sm:flex-row items-center justify-center px-4 py-4 bg-gray-50 border-t rounded-md">
            {{-- <div class="text-sm text-gray-600">
                Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} Users
            </div> --}}
            <div class="mt-2 sm:mt-0">
                {{ $users->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
     {{--  ADD USER MODAL --}}
    @include("admin.template.addModalUser")
    {{--  EDIT USER MODAL --}}
    @include("admin.template.EditModalUser")


 
    </div>

</div>

<!-- Scripts for search-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@vite(['resources/css/app.css', 'resources/js/app.js'])

</x-app-layout>
