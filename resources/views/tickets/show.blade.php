<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ticket Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4">{{ $ticket->title }}</h1>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p><strong>{{ __('Description:') }}</strong> {{ $ticket->description }}</p>
                            <p><strong>{{ __('Priority:') }}</strong> {{ $ticket->priority->name }}</p>
                            <p><strong>{{ __('Type:') }}</strong> {{ $ticket->ticket_type->name }}</p>
                            <p><strong>{{ __('Status:') }}</strong> {{ $ticket->ticket_status->name }}</p>
                            <p><strong>{{ __('Assigned To:') }}</strong> {{ $ticket->assignedTo ? $ticket->assignedTo->name : 'N/A' }}</p>
                            <p><strong>{{ __('Created By:') }}</strong> {{ $ticket->createdBy->name }}</p>
                            <p><strong>{{ __('Seeker Name:') }}</strong> {{ $ticket->seeker_name }}</p>
                            <p><strong>{{ __('Due Date:') }}</strong> {{ $ticket->due_date }}</p>
                            <p><strong>{{ __('Location:') }}</strong> {{ $ticket->location ? $ticket->location->location_name : 'N/A' }}</p>
                            <p><strong>{{ __('Asset:') }}</strong> {{ $ticket->asset ? $ticket->asset->description : 'N/A' }}</p>
                            <p><strong>{{ __('Assembly:') }}</strong> {{ $ticket->assembly ? $ticket->assembly->description : 'N/A' }}</p>
                        </div>
                    </div>

                    <h2 class="text-xl font-bold mt-6 mb-4">{{ __('Replies') }}</h2>
                    @forelse ($ticket->replies as $reply)
                        <div class="bg-gray-100 p-4 rounded-lg mb-4">
                            <p class="text-sm text-gray-600"><strong>{{ $reply->user->name }}</strong> on {{ $reply->created_at->format('M d, Y H:i A') }}</p>
                            <p>{{ $reply->description }}</p>
                        </div>
                    @empty
                        <p>{{ __('No replies yet.') }}</p>
                    @endforelse

                    <h2 class="text-xl font-bold mt-6 mb-4">{{ __('Add Reply') }}</h2>
                    <form action="{{ route('ticket-replies.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                        <div>
                            <x-label for="description" :value="__('Reply Description')" />
                            <textarea name="description" id="description" rows="3" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('description') }}</textarea>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Add Reply') }}
                            </x-button>
                        </div>
                    </form>

                    <div class="flex justify-end mt-6">
                        <a href="{{ route('tickets.edit', $ticket->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">
                            {{ __('Edit Ticket') }}
                        </a>
                        <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this ticket?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Delete Ticket') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
