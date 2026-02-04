<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('New Project Booking') }}
            </h2>
            <a href="{{ route('bookings.index') }}" class="text-sm text-gray-500 hover:text-gray-700 underline">
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700">
                
                <div class="px-5 py-6 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Booking Details</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Fill in the information below to create a new session.</p>
                </div>

                <div class="p-5">
                    @if ($errors->any())
                        <div class="mb-6 p-4 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-600 dark:text-red-400 text-sm">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('bookings.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Client Name</label>
                            <input type="text" 
                                   name="guest_name" 
                                   class="w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-green-500 focus:ring-green-500 shadow-sm transition-colors p-3" 
                                   placeholder="e.g. John Doe / The Beatles" 
                                   required>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Service</label>
                            <div class="relative">
                                <select name="service_id" 
                                        id="serviceSelect" 
                                        class="w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-green-500 focus:ring-green-500 shadow-sm transition-colors p-3 appearance-none" 
                                        required>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}" data-price="{{ $service->price }}">
                                            {{ $service->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Session Date</label>
                                <input type="datetime-local" 
                                       name="booking_date" 
                                       class="w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-green-500 focus:ring-green-500 shadow-sm p-3" 
                                       required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Deadline</label>
                                <input type="date" 
                                       name="deadline" 
                                       class="w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-green-500 focus:ring-green-500 shadow-sm p-3">
                            </div>
                        </div>

                        <div class="mb-8">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Notes</label>
                            <textarea name="client_notes" 
                                      rows="3" 
                                      class="w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-green-500 focus:ring-green-500 shadow-sm p-3" 
                                      placeholder="Specific requests, gear requirements, etc..."></textarea>
                        </div>

                        <div class="border-t border-gray-100 dark:border-gray-700 my-8"></div>

                        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                            
                            <div class="flex items-center gap-4 bg-green-50 dark:bg-green-900/30 px-6 py-4 rounded-xl border border-green-100 dark:border-green-800 w-full md:w-auto">
                                <div class="p-2 bg-green-100 dark:bg-green-800 rounded-lg text-green-600 dark:text-green-300">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-green-800 dark:text-green-200">Estimated Total</p>
                                    <p class="text-2xl font-bold text-green-700 dark:text-green-400" id="totalDisplay"> ₱0.00</p>
                                </div>
                            </div>

                            <button type="submit" 
                                    class="w-full md:w-auto px-8 py-4 bg-gray-900 dark:bg-white dark:text-gray-900 text-white font-bold rounded-xl hover:bg-gray-800 dark:hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-all shadow-lg transform hover:-translate-y-0.5">
                                Confirm Booking
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const select = document.getElementById('serviceSelect');
        const display = document.getElementById('totalDisplay');

        function updatePrice() {
            const selectedOption = select.options[select.selectedIndex];
            if(selectedOption) {
                const price = selectedOption.getAttribute('data-price');
                // Format currency nice and clean
                display.innerText = '₱' + parseFloat(price).toFixed(2);
            }
        }
        select.addEventListener('change', updatePrice);
        
        // Run once on load
        updatePrice(); 
    </script>
</x-app-layout>