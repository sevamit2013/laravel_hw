<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Ticket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($errors->any())
                        <div class="mb-4">
                            <div class="font-medium text-red-600">
                                {{ __('Whoops! Something went wrong.') }}
                            </div>
                            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="seeker_name" :value="__('Seeker Name')" />
                                <x-text-input id="seeker_name" class="block mt-1 w-full" type="text" name="seeker_name" :value="old('seeker_name', auth()->user()->name)" required />
                                <x-input-error :messages="$errors->get('seeker_name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="location_id" :value="__('Department/Location')" />
                                <select name="location_id" id="location_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                                    <option value="">Select Department</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->loc_code }}" {{ old('location_id') == $location->loc_code ? 'selected' : '' }}>
                                            {{ $location->location_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('location_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="priority_id" :value="__('Priority')" />
                                <select name="priority_id" id="priority_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                                    @foreach($priorities as $priority)
                                        <option value="{{ $priority->id }}" {{ old('priority_id') == $priority->id ? 'selected' : '' }}>
                                            {{ $priority->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('priority_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="ticket_type_id" :value="__('Ticket Type')" />
                                <select name="ticket_type_id" id="ticket_type_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                                    @foreach($ticketTypes as $ticketType)
                                        <option value="{{ $ticketType->type_id }}" {{ old('ticket_type_id') == $ticketType->type_id ? 'selected' : '' }}>
                                            {{ $ticketType->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('ticket_type_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="due_date" :value="__('Due Date')" />
                                <x-text-input id="due_date" class="block mt-1 w-full" type="date" name="due_date" :value="old('due_date')" required />
                                <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="asset_id" :value="__('Related Asset (Optional)')" />
                                <select name="asset_id" id="asset_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">None</option>
                                    @foreach($assets as $asset)
                                        <option value="{{ $asset->asset_id }}" {{ old('asset_id') == $asset->asset_id ? 'selected' : '' }}>
                                            {{ $asset->asset_code }} - {{ $asset->description }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('asset_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="assembly_id" :value="__('Related Assembly (Optional)')" />
                                <select name="assembly_id" id="assembly_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">None</option>
                                    @foreach($assemblies as $assembly)
                                        <option value="{{ $assembly->assembly_id }}" {{ old('assembly_id') == $assembly->assembly_id ? 'selected' : '' }}>
                                            {{ $assembly->assembly_code }} - {{ $assembly->description }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('assembly_id')" class="mt-2" />
                            </div>

                            @if(auth()->user()->hasAnyRole(['hw-admin', 'hw-subadmin', 'superadmin']))
                            <div>
                                <x-input-label for="assigned_to" :value="__('Assign To (Optional)')" />
                                <select name="assigned_to" id="assigned_to" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Unassigned</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('assigned_to') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('assigned_to')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="expected_time_hours" :value="__('Expected Time (Hours)')" />
                                <x-text-input id="expected_time_hours" class="block mt-1 w-full" type="number" min="0" name="expected_time_hours" :value="old('expected_time_hours')" />
                                <x-input-error :messages="$errors->get('expected_time_hours')" class="mt-2" />
                            </div>
                            @endif

                            <div class="md:col-span-2">
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea name="description" id="description" rows="5" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('description') }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>

                            <!-- File Attachments -->
                            <div class="md:col-span-2">
                                <x-input-label for="attachments" :value="__('Attachments (Images/Documents)')" />
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="attachments" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                <span>Upload files</span>
                                                <input id="attachments" name="attachments[]" type="file" class="sr-only" multiple accept="image/*,.pdf,.doc,.docx">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF, PDF, DOC up to 5MB each</p>
                                    </div>
                                </div>
                                <div id="file-list" class="mt-4 space-y-2"></div>
                                <x-input-error :messages="$errors->get('attachments.*')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6 gap-4">
                            <a href="{{ route('tickets.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Cancel
                            </a>
                            <x-primary-button>
                                {{ __('Create Ticket') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // File preview
        document.getElementById('attachments').addEventListener('change', function(e) {
            const fileList = document.getElementById('file-list');
            fileList.innerHTML = '';
            
            Array.from(e.target.files).forEach(file => {
                const fileItem = document.createElement('div');
                fileItem.className = 'flex items-center p-2 bg-gray-50 rounded';
                fileItem.innerHTML = `
                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm text-gray-700">${file.name}</span>
                    <span class="ml-auto text-xs text-gray-500">${(file.size / 1024).toFixed(2)} KB</span>
                `;
                fileList.appendChild(fileItem);
            });
        });
    </script>
    @endpush
</x-app-layout>