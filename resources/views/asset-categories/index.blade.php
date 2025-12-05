<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Asset Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="flex justify-between items-center mb-4">
                        <h1 class="text-2xl font-bold">
                            {{ __('Asset Categories') }}
                        </h1>

                        <a href="{{ route('asset-categories.create') }}"
                           class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent
                           rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm
                           hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400
                           focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Create Asset Category') }}
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table id="asset-categories-table" class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Description') }}
                                    </th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Is Software') }}
                                    </th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Inactive') }}
                                    </th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Actions') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                {{-- DataTables will populate --}}
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#asset-categories-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('asset-categories.index') }}',
                    columns: [
                        { data: 'description', name: 'description' },
                        { data: 'is_software', name: 'is_software' },
                        { data: 'inactive', name: 'inactive' },
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                    ]
                });
            });
        </script>
    @endpush
</x-app-layout>
