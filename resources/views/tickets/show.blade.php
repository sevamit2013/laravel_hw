<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ticket Details') }} #{{ $ticket->tkt_id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Ticket Information -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $ticket->title }}</h1>
                            <div class="flex gap-2 flex-wrap">
                                @php
                                    $statusColors = [
                                        'Open' => 'bg-green-100 text-green-800',
                                        'In Progress' => 'bg-blue-100 text-blue-800',
                                        'Closed' => 'bg-gray-100 text-gray-800',
                                        'Pending' => 'bg-yellow-100 text-yellow-800',
                                    ];
                                    $priorityColors = [
                                        'Low' => 'bg-green-100 text-green-800',
                                        'Medium' => 'bg-yellow-100 text-yellow-800',
                                        'High' => 'bg-red-100 text-red-800',
                                    ];
                                @endphp
                                <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $statusColors[$ticket->ticket_status->name] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $ticket->ticket_status->name }}
                                </span>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $priorityColors[$ticket->priority->name] ?? 'bg-gray-100 text-gray-800' }}">
                                    Priority: {{ $ticket->priority->name }}
                                </span>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">
                                    {{ $ticket->ticket_type->name }}
                                </span>
                                @if($ticket->isLate())
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                        Late
                                    </span>
                                @endif
                                @if($ticket->is_reopen)
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-orange-100 text-orange-800">
                                        Reopened
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="flex gap-2">
                            @if(auth()->user()->hasAnyRole(['hw-admin', 'hw-subadmin', 'superadmin']) || $ticket->created_by == auth()->id())
                                <a href="{{ route('tickets.edit', $ticket->tkt_id) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Edit
                                </a>
                            @endif
                            @if($ticket->is_closed && auth()->user()->hasAnyRole(['hw-admin', 'hw-subadmin', 'superadmin']))
                                <form action="{{ route('tickets.reopen', $ticket->tkt_id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Reopen Ticket
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Seeker</p>
                            <p class="text-base text-gray-900">{{ $ticket->seeker_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Department</p>
                            <p class="text-base text-gray-900">{{ $ticket->location->location_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Created By</p>
                            <p class="text-base text-gray-900">{{ $ticket->createdBy->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Assigned To</p>
                            <p class="text-base text-gray-900">{{ $ticket->assignedTo ? $ticket->assignedTo->name : 'Unassigned' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Due Date</p>
                            <p class="text-base {{ $ticket->isLate() ? 'text-red-600 font-semibold' : 'text-gray-900' }}">
                                {{ $ticket->due_date->format('M d, Y') }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Created</p>
                            <p class="text-base text-gray-900">{{ $ticket->created_at->format('M d, Y g:i A') }}</p>
                        </div>
                        @if($ticket->expected_time_hours)
                        <div>
                            <p class="text-sm font-medium text-gray-500">Expected Time</p>
                            <p class="text-base text-gray-900">{{ $ticket->expected_time_hours }} hours</p>
                        </div>
                        @endif
                        @if($ticket->actual_time_hours)
                        <div>
                            <p class="text-sm font-medium text-gray-500">Actual Time</p>
                            <p class="text-base text-gray-900">{{ $ticket->actual_time_hours }} hours</p>
                        </div>
                        @endif
                        @if($ticket->asset)
                        <div>
                            <p class="text-sm font-medium text-gray-500">Related Asset</p>
                            <p class="text-base text-gray-900">{{ $ticket->asset->asset_code }}</p>
                        </div>
                        @endif
                        @if($ticket->assembly)
                        <div>
                            <p class="text-sm font-medium text-gray-500">Related Assembly</p>
                            <p class="text-base text-gray-900">{{ $ticket->assembly->assembly_code }}</p>
                        </div>
                        @endif
                    </div>

                    <div class="mt-6">
                        <p class="text-sm font-medium text-gray-500 mb-2">Description</p>
                        <div class="prose max-w-none bg-gray-50 p-4 rounded-md">
                            {{ $ticket->description }}
                        </div>
                    </div>

                    <!-- Attachments -->
                    @if($ticket->attachments->count() > 0)
                    <div class="mt-6">
                        <p class="text-sm font-medium text-gray-500 mb-3">Attachments</p>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($ticket->attachments as $attachment)
                                <div class="border rounded-lg p-3 hover:bg-gray-50">
                                    @if($attachment->isImage())
                                        <img src="{{ $attachment->url }}" alt="{{ $attachment->original_filename }}" class="w-full h-32 object-cover rounded mb-2">
                                    @else
                                        <div class="w-full h-32 bg-gray-100 rounded flex items-center justify-center mb-2">
                                            <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    @endif
                                    <p class="text-xs text-gray-700 truncate">{{ $attachment->original_filename }}</p>
                                    <p class="text-xs text-gray-500">{{ $attachment->formatted_size }}</p>
                                    <a href="{{ $attachment->url }}" download class="text-xs text-blue-600 hover:text-blue-800">Download</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Replies Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" id="replies">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">
                        Communication
                        @if($ticket->replies->count() > 0)
                            <span class="text-sm text-gray-500 font-normal">({{ $ticket->replies->count() }} {{ Str::plural('reply', $ticket->replies->count()) }})</span>
                        @endif
                    </h2>

                    <!-- Reply Form -->
                    <form action="{{ route('ticket-replies.store') }}" method="POST" enctype="multipart/form-data" class="mb-6 bg-gray-50 p-4 rounded-lg">
                        @csrf
                        <input type="hidden" name="ticket_id" value="{{ $ticket->tkt_id }}">
                        
                        <div class="mb-4">
                            <x-input-label for="reply_description" :value="__('Your Reply')" />
                            <textarea name="description" id="reply_description" rows="4" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" placeholder="Type your response here..." required></textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="reply_attachments" :value="__('Attach Files (Optional)')" />
                            <input type="file" name="attachments[]" id="reply_attachments" multiple accept="image/*,.pdf,.doc,.docx" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="mt-1 text-xs text-gray-500">PNG, JPG, GIF, PDF, DOC up to 5MB each</p>
                        </div>

                        <div class="flex justify-end">
                            <x-primary-button>
                                {{ __('Post Reply') }}
                            </x-primary-button>
                        </div>
                    </form>

                    <!-- Replies List -->
                    <div class="space-y-4">
                        @forelse ($ticket->replies as $reply)
                            <div class="bg-white border border-gray-200 rounded-lg p-4 {{ $reply->unread ? 'border-l-4 border-l-blue-500' : '' }}">
                                <div class="flex items-start justify-between mb-2">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-semibold">
                                                {{ substr($reply->user->name, 0, 1) }}
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">{{ $reply->user->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $reply->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    @if($reply->unread)
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">New</span>
                                    @endif
                                </div>
                                <div class="ml-13 text-sm text-gray-700 whitespace-pre-wrap">{{ $reply->description }}</div>
                                
                                {{-- Reply attachments not supported yet - database doesn't have reply_id column
@if($reply->attachments->count() > 0)
    <div class="ml-13 mt-3 flex flex-wrap gap-2">
        @foreach($reply->attachments as $attachment)
            <a href="{{ $attachment->url }}" target="_blank" class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md text-xs text-gray-700 hover:bg-gray-50">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"/>
                </svg>
                {{ $attachment->original_filename }}
            </a>
        @endforeach
    </div>
@endif
--}}
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                                <p class="mt-2 text-sm text-gray-500">No replies yet. Be the first to respond!</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <script>
            setTimeout(() => {
                document.getElementById('replies').scrollIntoView({ behavior: 'smooth' });
            }, 100);
        </script>
    @endif
</x-app-layout>