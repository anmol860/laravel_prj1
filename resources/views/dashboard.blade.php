<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            💰 My Wallet Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="mb-6">
                    <h3 class="text-2xl font-bold mb-4 dark:text-white">
                        Balance: ${{ number_format($balance ?? 0) }}
                    </h3>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <p class="text-green-600 font-bold dark:text-green-400">
                            Income: +${{ number_format($totalIncome ?? 0) }}
                        </p>
                        <p class="text-red-600 font-bold dark:text-red-400">
                            Expenses: -${{ number_format($totalExpense ?? 0) }}
                        </p>
                    </div>
                </div>

                <hr class="border-gray-200 dark:border-gray-700 my-6">

                <div class="mb-6">
                    <h3 class="text-lg font-medium mb-4 dark:text-white">Add Transaction</h3>
                    
                    <form action="/add-transaction" method="POST" class="flex flex-col md:flex-row gap-3">
                        @csrf
                        
                        <input type="text" name="name" placeholder="Description" required
                            class="rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                        
                        <input type="number" name="amount" placeholder="Amount" required
                            class="rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm w-32">
                        
                        <select name="type" class="rounded-md border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                            <option value="expense">Expense (-)</option>
                            <option value="income">Income (+)</option>
                        </select>

                        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700 dark:bg-white dark:text-gray-800 dark:hover:bg-gray-200 transition">
                            Add
                        </button>
                    </form>
                </div>

                <hr class="border-gray-200 dark:border-gray-700 my-6">

                <div>
                    <h3 class="text-lg font-medium mb-4 dark:text-white">History</h3>
                    
                    <ul class="space-y-3">
                        @if(isset($transactions))
                            @foreach($transactions as $txn)
                                <li class="flex justify-between items-center bg-gray-50 dark:bg-gray-700 p-3 rounded-md">
                                    <span class="dark:text-white">{{ $txn->name }}</span>
                                    
                                    <div class="text-right">
                                        <span class="font-bold {{ $txn->type == 'income' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                            {{ $txn->type == 'income' ? '+' : '-' }}${{ number_format($txn->amount) }}
                                        </span>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $txn->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <p class="text-gray-500">No transactions found.</p>
                        @endif
                    </ul>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>