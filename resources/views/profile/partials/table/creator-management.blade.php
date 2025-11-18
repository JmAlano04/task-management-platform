 @forelse ($taskForcreator as $taskForcreators)
                        <tr class="hover:bg-secondary-light transition duration-150 ease-in-out">
                            <td class="px-6 py-3 text-xs">{{ $taskForcreators->title ?? 'N/A' }}</td>
                            <td class="px-6 py-3 text-xs">{{ $taskForcreators->taker?->name ?? 'N/A' }}</td>
                            <td class="px-6 py-3 text-xs">{{ $taskForcreators->description ?? 'N/A' }}</td>
                            <td class="px-6 py-3 text-xs">
                                {{ $taskForcreators->due_date ? \Carbon\Carbon::parse($taskForcreators->due_date)->format('M d, Y') : 'N/A' }}
                            </td>
                            <td class="px-6 py-3 text-xs">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $taskForcreators->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($taskForcreators->status ?? 'Pending') }}
                                </span>
                            </td>
                            <td class="px-4 mt-4 py-3 flex space-x-2">
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
                                     <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="blue" viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M505 122.9L517.1 135C526.5 144.4 526.5 159.6 517.1 168.9L488 198.1L441.9 152L471 122.9C480.4 113.5 495.6 113.5 504.9 122.9zM273.8 320.2L408 185.9L454.1 232L319.8 366.2C316.9 369.1 313.3 371.2 309.4 372.3L250.9 389L267.6 330.5C268.7 326.6 270.8 323 273.7 320.1zM437.1 89L239.8 286.2C231.1 294.9 224.8 305.6 221.5 317.3L192.9 417.3C190.5 425.7 192.8 434.7 199 440.9C205.2 447.1 214.2 449.4 222.6 447L322.6 418.4C334.4 415 345.1 408.7 353.7 400.1L551 202.9C579.1 174.8 579.1 129.2 551 101.1L538.9 89C510.8 60.9 465.2 60.9 437.1 89zM152 128C103.4 128 64 167.4 64 216L64 488C64 536.6 103.4 576 152 576L424 576C472.6 576 512 536.6 512 488L512 376C512 362.7 501.3 352 488 352C474.7 352 464 362.7 464 376L464 488C464 510.1 446.1 528 424 528L152 528C129.9 528 112 510.1 112 488L112 216C112 193.9 129.9 176 152 176L264 176C277.3 176 288 165.3 288 152C288 138.7 277.3 128 264 128L152 128z"/></svg>
                                </button>

                                {{-- Delete Form --}}
                                <form action="{{ route('createtask.destroy', $taskForcreators->id) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this task?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-200 p-1 rounded-sm hover:bg-red-300 transition duration-150 ease-in-out">
                                         <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="red" viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M232.7 69.9L224 96L128 96C110.3 96 96 110.3 96 128C96 145.7 110.3 160 128 160L512 160C529.7 160 544 145.7 544 128C544 110.3 529.7 96 512 96L416 96L407.3 69.9C402.9 56.8 390.7 48 376.9 48L263.1 48C249.3 48 237.1 56.8 232.7 69.9zM512 208L128 208L149.1 531.1C150.7 556.4 171.7 576 197 576L443 576C468.3 576 489.3 556.4 490.9 531.1L512 208z"/></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-3 text-center text-gray-500">No task records found.</td>
                        </tr>
                    @endforelse