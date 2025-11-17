   @php
        $user = Auth::user();
    @endphp
 @if($user->role === 'admin')
@forelse ($task as $tasks)
<tr class="hover:bg-secondary-light transition duration-150 ease-in-out">
<td class="px-6 py-3">{{ $tasks->id ?? 'N/A' }}</td>
                    <td class="px-6 py-3">{{ $tasks->creator?->name ?? 'N/A' }}</td>
                    <td class="px-6 py-3">{{ $tasks->title ?? 'N/A' }}</td>
                    <td class="px-6 py-3">{{ $tasks->taker?->name ?? 'N/A' }}</td>
                    <td class="px-6 py-3">{{ $tasks->description ?? 'N/A' }}</td>
                    <td class="px-6 py-3">{{ $tasks->due_date ? \Carbon\Carbon::parse($tasks->due_date)->format('M d, Y') : 'N/A' }}</td>
                    <td class="px-6 py-3">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $tasks->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($tasks->status ?? 'Pending') }}
                        </span>
    </td>

    <!-- Actions -->     
    <td class="px-4 mt-4 py-3 whitespace-nowrap flex space-x-2">
        {{-- Edit Button --}}
        <button 
            @click="
                modalType = 'Edit';
                modalTitle = 'Edit Task';
                modalAction = '{{ route('task.update', $tasks->id) }}';
                modalData = {
                    title: '{{ $tasks->title }}',
                    description: '{{ $tasks->description }}',
                    taker_id: '{{ $tasks->taker?->id ?? '' }}',
                    created_by_id: '{{ $tasks->creator?->id ?? '' }}',
                    due_date: '{{ $tasks->due_date }}',
                    status: '{{ $tasks->status }}'
                };
                showEdit = true;
            "
            class="bg-blue-200 p-1 rounded-sm hover:bg-blue-300 transition duration-150 ease-in-out"
        >
           Edit
        </button>

        {{-- Delete Form --}}
        <form action="{{ route('task-management.destroy', $tasks->id) }}" method="POST"
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
@endif

@if($user->role === 'creator')

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

@endif