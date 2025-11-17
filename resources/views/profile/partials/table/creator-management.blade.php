 @forelse ($taskForcreator as $taskForcreators)
                        <tr class="hover:bg-secondary-light transition duration-150 ease-in-out">
                             @if($user->role === 'admin')
                            <td class="px-6 py-3">{{ $taskForcreators->id ?? 'N/A' }}</td>
                            <td class="px-6 py-3">{{ $taskForcreators->creator?->name ?? 'N/A' }}</td>
                            @endif
                            @if($user->role === 'creator')
                                <td hidden class="px-6 py-3">{{ $taskForcreators->id ?? 'N/A' }}</td>
                                <td hidden class="px-6 py-3">{{ $taskForcreators->creator?->name ?? 'N/A' }}</td>
                            @endif
                   
                            <td class="px-6 py-3">{{ $taskForcreators->title ?? 'N/A' }}</td>
                            <td class="px-6 py-3">{{ $taskForcreators->taker?->name ?? 'N/A' }}</td>
                            <td class="px-6 py-3">{{ $taskForcreators->description ?? 'N/A' }}</td>
                            <td class="px-6 py-3">
                                {{ $taskForcreators->due_date ? \Carbon\Carbon::parse($taskForcreators->due_date)->format('M d, Y') : 'N/A' }}
                            </td>
                            <td class="px-6 py-3">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $taskForcreators->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($taskForcreators->status ?? 'Pending') }}
                                </span>
                            </td>
                            <td class="px-4 mt-4 py-3 whitespace-nowrap flex space-x-2">
                                {{-- Edit Button --}}
                                <button 
                                    @click="
                                        modalType = 'Edit';
                                        modalTitle = 'Edit Task';
                                        modalAction = '{{ route('createtask.update', $taskForcreators->id) }}';
                                        modalData = {
                                            title: '{{ $taskForcreators->title }}',
                                            description: '{{ $taskForcreators->description }}',
                                            taker_id: '{{ $taskForcreators->taker?->id ?? '' }}',
                                            created_by_id: '{{ $taskForcreators->creator?->id ?? '' }}',
                                            due_date: '{{ $taskForcreators->due_date }}',
                                            status: '{{ $taskForcreators->status }}'
                                        };
                                        showEdit = true;
                                    "
                                    class="bg-blue-200 p-1 rounded-sm hover:bg-blue-300 transition duration-150 ease-in-out"
                                >
                                    Edit
                                </button>

                                {{-- Delete Form --}}
                                <form action="{{ route('createtask.destroy', $taskForcreators->id) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this task?');">
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
                            <td colspan="8" class="px-4 py-3 text-center text-gray-500">No task records found.</td>
                        </tr>
                    @endforelse