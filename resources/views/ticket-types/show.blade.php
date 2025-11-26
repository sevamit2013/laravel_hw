<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ticket Type Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <p><strong>ID:</strong> {{ $ticketType->type_id }}</p>
                        <p><strong>Name:</strong> {{ $ticketType->name }}</p>
                        <p><strong>Inactive:</strong> {{ $ticketType->inactive ? 'Yes' : 'No' }}</p>
                        <p><strong>Created At:</strong> {{ $ticketType->created_at }}</p>
                        <p><strong>Updated At:</strong> {{ $ticketType->updated_at }}</p>
                    </div>

                    <div class="flex items-center">
                        <a href="{{ route('ticket-types.edit', $ticketType) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            {{ __('Edit') }}
                        </a>

                        <form action="{{ route('ticket-types.destroy', $ticketType) }}" method="POST" class="inline-block ml-2">
                            @csrf
                            @method('DELETE')
                            <x-danger-button>
                                {{ __('Delete') }}
                            </x-danger-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>