<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </div>
            <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight tracking-tight">
                {{ __('Studio Configuration') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <div class="flex flex-col h-[32rem]">
                    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl border border-gray-200 dark:border-gray-700 flex flex-col h-full overflow-hidden">
                        
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50 flex justify-between items-center shrink-0">
                            <h3 class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-wider flex items-center gap-2">
                                <span class="p-1 bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400 rounded-md">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 3-2 3-2zm0 0v-8"></path></svg>
                                </span>
                                Service Catalog
                            </h3>
                            <span class="text-xs font-medium px-2 py-1 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 rounded-md">{{ $services->count() }} Items</span>
                        </div>

                        <div class="p-4 border-b border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-800 shrink-0">
                            <form action="{{ route('services.store') }}" method="POST" class="flex flex-col sm:flex-row gap-3">
                                @csrf
                                <div class="flex-grow">
                                    <label class="sr-only">Service Name</label>
                                    <input type="text" name="name" placeholder="New Service Name" required
                                           class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm py-2">
                                </div>
                                <div class="relative w-full sm:w-28">
                                    <span class="absolute left-3 top-2 text-gray-400 text-sm font-mono">₱</span>
                                    <input type="number" step="0.01" name="price" placeholder="0.00" required
                                           class="w-full pl-7 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm font-mono py-2">
                                </div>
                                <button type="submit" class="bg-gray-900 hover:bg-black dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200 text-white px-4 py-2 rounded-lg text-sm font-bold shadow-sm transition-all flex items-center justify-center">
                                    Add
                                </button>
                            </form>
                        </div>

                        <div class="flex-grow overflow-y-auto bg-white dark:bg-gray-800">
                            <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-700 sticky top-0">
                                <thead class="bg-gray-50 dark:bg-gray-700/30 sticky top-0 z-10">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Service</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Price</th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Availability</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                    @foreach($services as $service)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/20 transition-colors group">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-800 dark:text-gray-200">
                                            {{ $service->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400 font-mono">
                                            ₱{{ number_format($service->price, 2) }}
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            <form action="{{ route('services.toggle', $service->id) }}" method="POST" class="flex items-center justify-end">
                                                @csrf @method('PATCH')

                                                @if($service->is_active)
                                                    <button type="submit" role="switch" aria-checked="true"
                                                        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 bg-green-500">
                                                        <span class="sr-only">Toggle availability</span>
                                                        <span aria-hidden="true" 
                                                              class="translate-x-5 pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out">
                                                        </span>
                                                    </button>
                                                @else
                                                    <button type="submit" role="switch" aria-checked="false"
                                                        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 bg-red-500">
                                                        <span class="sr-only">Toggle availability</span>
                                                        <span aria-hidden="true" 
                                                              class="translate-x-0 pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out">
                                                        </span>
                                                    </button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col h-[32rem]">
                    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl border border-gray-200 dark:border-gray-700 flex flex-col h-full overflow-hidden">
                        
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50 flex justify-between items-center shrink-0">
                            <h3 class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-wider flex items-center gap-2">
                                <span class="p-1 bg-purple-100 text-purple-600 dark:bg-purple-900/30 dark:text-purple-400 rounded-md">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </span>
                                Engineering Team
                            </h3>
                            <span class="text-xs font-medium px-2 py-1 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 rounded-md">{{ $techs->count() }} Staff</span>
                        </div>

                        <div class="p-4 border-b border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-800 shrink-0">
                            <form action="{{ route('techs.store') }}" method="POST" class="flex flex-col gap-3">
                                @csrf
                                <div class="flex flex-col sm:flex-row gap-3">
                                    <div class="w-full sm:w-1/2">
                                        <label class="sr-only">Name</label>
                                        <input type="text" name="name" placeholder="Engineer Name" required
                                               class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:border-purple-500 focus:ring-purple-500 text-sm py-2">
                                    </div>
                                    <div class="w-full sm:w-1/2">
                                        <label class="sr-only">Email</label>
                                        <input type="email" name="email" placeholder="Email Address" required
                                               class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:border-purple-500 focus:ring-purple-500 text-sm py-2">
                                    </div>
                                </div>
                                <button type="submit" class="w-full bg-gray-900 hover:bg-black text-white font-bold py-2 rounded-lg shadow-sm transition-all focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 flex justify-center items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                                    Hire New Engineer
                                </button>
                            </form>
                        </div>

                        <div class="flex-grow overflow-y-auto bg-white dark:bg-gray-800">
                            <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-700 sticky top-0">
                                <thead class="bg-gray-50 dark:bg-gray-700/30 sticky top-0 z-10">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Profile</th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                    @if($techs->isEmpty())
                                        <tr>
                                            <td colspan="2" class="px-6 py-8 text-center text-sm text-gray-400 italic">
                                                No engineers found. Add one above.
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($techs as $tech)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/20 transition-colors group">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex flex-col">
                                                    <div class="text-sm font-bold text-gray-900 dark:text-white {{ !$tech->is_active ? 'line-through text-gray-400 opacity-60' : '' }}">
                                                        {{ $tech->name }}
                                                    </div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400 font-mono">
                                                        {{ $tech->email }}
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                                <form action="{{ route('techs.toggle', $tech->id) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    @if($tech->is_active)
                                                        <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 hover:bg-green-200 transition-colors border border-green-200 dark:border-green-800/50">
                                                            <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                                            Active
                                                        </button>
                                                    @else
                                                        <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400 hover:bg-gray-200 transition-colors border border-gray-200 dark:border-gray-600">
                                                            <span class="w-2 h-2 rounded-full bg-gray-400"></span>
                                                            Archived
                                                        </button>
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>