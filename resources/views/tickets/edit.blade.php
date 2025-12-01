<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Ticket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('tickets.update', ['tkt_id' => $ticket->tkt_id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $ticket->title)" required autofocus />
                            </div>
                            <div>
                                <x-input-label for="priority_id" :value="__('Priority')" />
                                <select name="priority_id" id="priority_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @foreach($priorities as $priority)
                                        <option value="{{ $priority->id }}" {{ $ticket->priority_id == $priority->id ? 'selected' : '' }}>{{ $priority->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label for="ticket_type_id" :value="__('Ticket Type')" />
                                <select name="ticket_type_id" id="ticket_type_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @foreach($ticketTypes as $ticketType)
                                        <option value="{{ $ticketType->id }}" {{ $ticket->ticket_type_id == $ticketType->id ? 'selected' : '' }}>{{ $ticketType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label for="assigned_to" :value="__('Assigned To')" />
                                <select name="assigned_to" id="assigned_to" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">{{ __('None') }}</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ $ticket->assigned_to == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label for="ticket_status_id" :value="__('Status')" />
                                <select name="ticket_status_id" id="ticket_status_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @foreach($ticketStatuses as $status)
                                        <option value="{{ $status->id }}" {{ $ticket->ticket_status_id == $status->id ? 'selected' : '' }}>{{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea name="description" id="description" rows="5" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('description', $ticket->description) }}</textarea>
                            </div>
                             <div>
                                <x-input-label for="seeker_name" :value="__('Seeker Name')" />
                                <x-text-input id="seeker_name" class="block mt-1 w-full" type="text" name="seeker_name" :value="old('seeker_name', $ticket->seeker_name)" required />
                            </div>
                            <div>
                                <x-input-label for="due_date" :value="__('Due Date')" />
                                <x-text-input id="due_date" class="block mt-1 w-full" type="date" name="due_date" :value="old('due_date', $ticket->due_date)" required />
                            </div>
                            <div>
                                <x-input-label for="location_id" :value="__('Location')" />
                                <select name="location_id" id="location_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}" {{ $ticket->location_id == $location->id ? 'selected' : '' }}>{{ $location->location_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label for="asset_id" :value="__('Asset')" />
                                <select name="asset_id" id="asset_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">{{ __('None') }}</option>
                                    @foreach($assets as $asset)
                                        <option value="{{ $asset->id }}" {{ $ticket->asset_id == $asset->id ? 'selected' : '' }}>{{ $asset->asset_code }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label for="assembly_id" :value="__('Assembly')" />
                                <select name="assembly_id" id="assembly_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">{{ __('None') }}</option>
                                    @foreach($assemblies as $assembly)
                                        <option value="{{ $assembly->id }}" {{ $ticket->assembly_id == $assembly->id ? 'selected' : '' }}>{{ $assembly->description }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    <button type="submit">Update Ticket</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
