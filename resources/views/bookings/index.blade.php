<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-gray-900 dark:text-white tracking-tight">
                    Active Projects
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    You have <span class="font-bold text-indigo-600">{{ $bookings->count() }}</span> ongoing projects.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('bookings.history') }}" class="px-5 py-2.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-semibold text-gray-700 dark:text-gray-300 hover:bg-gray-50 hover:shadow-sm transition-all">
                    History
                </a>
                <a href="{{ route('bookings.create') }}" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-indigo-200 dark:shadow-none hover:shadow-indigo-300 transition-all transform hover:-translate-y-0.5">
                    + New Project
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if($bookings->isEmpty())
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-12 text-center border border-dashed border-gray-300 dark:border-gray-700">
                    <div class="w-16 h-16 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">No active projects</h3>
                    <p class="text-gray-500 mt-1 mb-6">Your schedule is clear! Create a booking to get started.</p>
                </div>
            @else
                <div class="hidden md:grid grid-cols-12 gap-4 px-6 mb-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                    <div class="col-span-4">Client & Service</div>
                    <div class="col-span-3">Timeline</div>
                    <div class="col-span-3">Assignment</div>
                    <div class="col-span-2 text-right">Action</div>
                </div>

                <div class="space-y-3">
                    @foreach($bookings as $booking)
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md hover:border-indigo-100 dark:hover:border-indigo-900 transition-all duration-200 p-5 group">
                            
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
                                
                                <div class="col-span-4 flex items-start gap-4">
                                    <div class="flex-shrink-0 h-12 w-12 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-lg shadow-sm">
                                        {{ substr($booking->client_name, 0, 1) }}
                                    </div>
                                    
                                    <div>
                                        <h3 class="font-bold text-gray-900 dark:text-white text-lg leading-tight">
                                            {{ $booking->client_name }}
                                        </h3>
                                        <div class="text-sm font-medium text-indigo-600 dark:text-indigo-400 mt-0.5">
                                            {{ $booking->service->name }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-span-3">
                                    <div class="flex flex-col">
                                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Due Date</span>
                                        <div class="flex items-center gap-2 mt-1">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            <span class="font-medium {{ $booking->deadline && $booking->deadline->isPast() ? 'text-red-600' : 'text-gray-700 dark:text-gray-200' }}">
                                                {{ $booking->deadline ? $booking->deadline->format('M d, Y') : 'No Date' }}
                                            </span>
                                        </div>
                                        @if($booking->deadline)
                                            <span class="text-xs text-gray-500 mt-1">
                                                {{ $booking->deadline->diffForHumans() }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-span-3">
                                    <form action="{{ route('booking.assign', $booking->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1">Audio Eng.</label>
                                        <div class="relative">
                                            <select name="tech_id" onchange="this.form.submit()" 
                                                class="appearance-none w-full bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 py-2 pl-3 pr-8 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 cursor-pointer hover:bg-white transition-colors">
                                                <option value="">Unassigned</option>
                                                @foreach($techs as $tech)
                                                    <option value="{{ $tech->id }}" {{ $booking->assigned_tech_id == $tech->id ? 'selected' : '' }}>
                                                        {{ $tech->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-span-2 flex justify-end">
                                    <form action="{{ route('booking.complete', $booking->id) }}" method="POST" onsubmit="return confirm('Complete this project?');">
                                        @csrf @method('PATCH')
                                        <button 
                                             type="submit" 
                                             class="group flex items-center justify-center px-4 py-2 rounded-full bg-green-50 hover:bg-green-100 text-green-600 transition-colors border border-green-200 text-sm font-semibold" 
                                              title="Mark as Complete">
                                                DONE
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>