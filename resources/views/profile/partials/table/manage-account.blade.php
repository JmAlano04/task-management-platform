 @forelse ($users as $user)
                <tr class="hover:bg-secondary-light transition duration-150 ease-in-out">
                    <td class="px-4 py-3 whitespace-nowrap">{{ $user->id }}</td>
                    <td class="px-4 py-3 whitespace-nowrap">{{ $user->name }}</td>
                    <td class="px-4 py-3 whitespace-nowrap">{{ $user->email }}</td>
                    <td class="px-4 py-3 whitespace-nowrap">{{ $user->role }}</td>
                    <td class="px-4 py-3 whitespace-nowrap flex space-x-2">

                        {{-- Edit Button --}}
                       <button 
                          @click="
                                modalType = 'Edit';
                                modalTitle = 'Edit User';
                                modalAction = '{{ route('users.update', $user->id) }}';
                                modalData = {
                                name: '{{ $user->name }}',
                                    email: '{{ $user->email }}',
                                    role: '{{ $user->role }}'
                                };
                                showEdit = true;
                                
                                    "
                                   class="bg-blue-200 p-1 rounded-sm hover:bg-blue-300 transition duration-150 ease-in-out"
                            >
                                Edit
                    </button>


                        {{-- Delete Form --}}
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-200 p-1 rounded-sm hover:bg-red-300 transition duration-150 ease-in-out">
                                Delete
                            </button>
                        </form>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-3 text-center text-gray-500">No user records found.</td>
                </tr>
                @endforelse

