<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <!-- Card 1 -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    {{remainingDays('2023-08-01')}}
                </div>

                <!-- Card 2 -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    Content for Card 2
                </div>

                <!-- Card 3 -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    Content for Card 3
                </div>

                <!-- Card 4 -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    Content for Card 4
                </div>

                <!-- Card 5 -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    Content for Card 5
                </div>

                <!-- Card 6 -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    Content for Card 6
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-4">
                <!-- Card 1 -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <!-- Invoice Design -->
                    <h2 class="text-lg font-semibold mb-2">Invoice</h2>
                    <div class="border-t border-gray-300 pt-2">
                        <p class="text-sm"><strong>Bill To:</strong></p>
                        <p>John Doe</p>
                        <p>123 Main Street</p>
                        <p>City, State 12345</p>
                    </div>
                    <div class="border-t border-gray-300 pt-2">
                        <p class="text-sm"><strong>Ship To:</strong></p>
                        <p>Jane Smith</p>
                        <p>456 Elm Avenue</p>
                        <p>City, State 67890</p>
                    </div>
                    <table class="border-collapse w-full mt-4">
                        <thead>
                        <tr>
                            <th class="border border-gray-300 px-2 py-1">Item</th>
                            <th class="border border-gray-300 px-2 py-1">Description</th>
                            <th class="border border-gray-300 px-2 py-1">Quantity</th>
                            <th class="border border-gray-300 px-2 py-1">Price</th>
                            <th class="border border-gray-300 px-2 py-1">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="border border-gray-300 px-2 py-1">Item 1</td>
                            <td class="border border-gray-300 px-2 py-1">Product description</td>
                            <td class="border border-gray-300 px-2 py-1">2</td>
                            <td class="border border-gray-300 px-2 py-1">$50.00</td>
                            <td class="border border-gray-300 px-2 py-1">$100.00</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-2 py-1">Item 2</td>
                            <td class="border border-gray-300 px-2 py-1">Another product description</td>
                            <td class="border border-gray-300 px-2 py-1">1</td>
                            <td class="border border-gray-300 px-2 py-1">$75.00</td>
                            <td class="border border-gray-300 px-2 py-1">$75.00</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="text-right mt-4">
                        <p><strong>Total: $175.00</strong></p>
                        <!-- Payment Method Selection -->
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Select Payment Method:</label>
                            <select class="mt-1  w-48 p-2 border border-gray-300 rounded-md">
                                <option value="bkash">Bkash</option>
                                <option value="bkash">Bkash</option>
                                <option value="bkash">Bkash</option>

                            </select>
                        </div>
                        <!-- Pay Now Button -->
                        <div class="mt-4 text-right">
                            <button class="px-4 py-2  text-white rounded-md" style="background-color: green">Pay Now</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
