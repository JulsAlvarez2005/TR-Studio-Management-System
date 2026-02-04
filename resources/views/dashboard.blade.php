<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight flex items-center gap-2">
            <span>📊</span> Executive Overview
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ showIncomeModal: false }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Projects (Month)</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $projectsMonth }}</p>
                    </div>
                    <div class="p-3 bg-blue-50 dark:bg-blue-900/20 rounded-xl">
                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Projects (Year)</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $projectsYear }}</p>
                    </div>
                    <div class="p-3 bg-indigo-50 dark:bg-indigo-900/20 rounded-xl">
                        <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                </div>

                <div @click="showIncomeModal = true" 
                     class="group cursor-pointer bg-gradient-to-br from-green-500 to-emerald-600 p-6 rounded-2xl shadow-lg shadow-green-200 dark:shadow-none transform transition-all hover:scale-105 hover:shadow-xl relative overflow-hidden">
                    
                    <div class="absolute -right-6 -top-6 w-32 h-32 bg-white opacity-10 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
                    
                    <div class="relative z-10 flex items-center justify-between text-white">
                        <div>
                            <p class="text-sm font-medium text-green-100 uppercase tracking-wider flex items-center gap-1">
                                Total Revenue 
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                            </p>
                            <p class="text-3xl font-bold mt-1">₱{{ number_format($totalIncome, 2) }}</p>
                            <p class="text-xs text-green-100 mt-2 bg-white/20 inline-block px-2 py-1 rounded-lg">Tap to view report</p>
                        </div>
                        <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-2xl border border-gray-100 dark:border-gray-700">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white flex items-center gap-2">
                            <span class="text-red-500">📅</span> Upcoming Deadlines
                        </h3>
                        <span class="px-3 py-1 text-xs font-semibold bg-gray-100 dark:bg-gray-700 rounded-full text-gray-600 dark:text-gray-300">
                            {{ count($deadlines) }} Active
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($deadlines as $deadline)
                            <div class="group relative bg-white dark:bg-gray-900 p-5 rounded-xl border border-gray-200 dark:border-gray-700 hover:border-red-400 dark:hover:border-red-500 transition-colors shadow-sm hover:shadow-md">
                                <div class="absolute left-0 top-4 bottom-4 w-1 bg-red-500 rounded-r-full"></div>
                                
                                <div class="pl-3">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="text-xs font-bold text-red-500 uppercase tracking-wide mb-1">
                                                Due {{ $deadline->deadline ? $deadline->deadline->format('M d') : 'No Date' }}
                                            </p>
                                            <h4 class="font-bold text-gray-900 dark:text-white text-lg leading-tight mb-1">
                                                {{ $deadline->service ? $deadline->service->name : 'Unknown Service' }}
                                            </h4>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                                {{ $deadline->client_name }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div x-show="showIncomeModal" 
             style="display: none;"
             class="fixed inset-0 z-50 overflow-y-auto" 
             aria-labelledby="modal-title" role="dialog" aria-modal="true">
            
            <div x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" 
                 @click="showIncomeModal = false"></div>

            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="relative transform overflow-hidden rounded-lg bg-white dark:bg-gray-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl">
                    
                    <div class="bg-white dark:bg-gray-800 px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start w-full">
                            <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                <h3 class="text-xl font-semibold leading-6 text-gray-900 dark:text-white mb-4" id="modal-title">
                                    💰 Annual Income Report
                                </h3>
                                <div class="w-full h-64">
                                    <canvas id="incomeChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button" @click="showIncomeModal = false" class="inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('incomeChart').getContext('2d');
            
            // NOTE: If you passed $monthlyIncome from controller, use this:
            // const incomeData = @json($monthlyIncome ?? []);
            
            
            // REAL DATA from Controller
             const incomeData = @json($monthlyIncome);

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Monthly Income (₱)',
                        data: incomeData,
                        backgroundColor: 'rgba(34, 197, 94, 0.6)', // Green-500
                        borderColor: 'rgba(34, 197, 94, 1)',
                        borderWidth: 1,
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(156, 163, 175, 0.1)' },
                            ticks: { color: '#9CA3AF' }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: '#9CA3AF' }
                        }
                    },
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        });
    </script>
</x-app-layout>