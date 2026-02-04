<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('📜 Project History') }}
            </h2>
            <a href="{{ route('bookings.index') }}" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 underline transition-colors">
                ← Back to Active
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if($historyGroups->isEmpty())
                <div class="text-center text-gray-400 mt-10">
                    <p>No completed projects yet.</p>
                </div>
            @else
                @foreach($historyGroups as $month => $bookings)
                    
                    <div class="mb-20">
                        <div class="flex items-center gap-3 mb-4 px-2 pt-4">
                            <span class="bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">Period</span>
                            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200">
                                {{ $month }}
                            </h3>
                        </div>

                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700">
                            <div class="overflow-x-auto">
                                <table class="w-full text-left">
                                    <thead class="bg-gray-50 dark:bg-gray-700 border-b border-gray-100 dark:border-gray-600">
                                        <tr>
                                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Project / Service</th>
                                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Client</th>
                                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider text-right">Fee</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                        @foreach($bookings as $booking)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400 whitespace-nowrap">
                                                {{ $booking->booking_date->format('d M, Y') }}
                                                <div class="text-xs text-gray-400">{{ $booking->booking_date->format('h:i A') }}</div>
                                            </td>
                                            
                                            <td class="px-6 py-4">
                                                <div class="font-bold text-gray-900 dark:text-white">{{ $booking->service->name }}</div>
                                                @if($booking->assigned_tech_id)
                                                    <div class="flex items-center mt-1">
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300">
                                                            Tech: {{ $booking->tech->name }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </td>

                                            <td class="px-6 py-4">
                                                <div class="text-gray-900 dark:text-white font-medium">{{ $booking->client_name }}</div>
                                            </td>

                                            <td class="px-6 py-4 text-right">
                                                <span class="font-mono font-semibold text-green-600 dark:text-green-400">
                                                    ₱{{ number_format($booking->service->price, 2) }}
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="bg-gray-50 dark:bg-gray-900/50 px-6 py-4 border-t border-gray-100 dark:border-gray-700 flex justify-between items-center">
                                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Revenue for {{ $month }}</span>
                                <div class="text-xl font-bold text-green-700 dark:text-green-400 flex items-center gap-2">
                                    <span>₱{{ number_format($bookings->sum(fn($b) => $b->service->price), 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</x-app-layout>