<x-guest-layout>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-4">
                <!-- Card 1 -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <!-- Invoice Design -->
                    <h2 class="text-lg font-semibold mb-2">Invoice</h2>
                    <div class="border-t border-gray-300 pt-2">
                        <p class="text-sm"><strong>Bill To:</strong></p>
                        <p>{{$user->first_name}} {{$user->last_name}}</p>
                        <p>{{$user->email}}, {{$user->phone}}</p>
                        <p>{{$user->address}}, {{$user->zip_code}}</p>
                        <p>{{$user->city}}, {{$user->state}}, {{$user->country}}</p>

                    </div>
                    <div class="border-t border-gray-300 pt-2">
                        <p class="text-sm"><strong>Product Information:</strong></p>
                        <p>Product Name : {{$product->name}}</p>
                        <p>Billing : {{$product->billing}}</p>
                        <p>Amount : {{$product->price}}</p>
                        <p>Purchased : {{$product->start_date}}</p>
                        <p>Expired : {{$product->end_date}}</p>
                    </div>
                    <div class="border-t border-gray-300 pt-2">
                        <p class="text-sm"><strong>Next Expire (After Payment)</strong></p>
                        <p> {{$product->end_date}}</p>
                    </div>

                    <div class="text-right mt-4">
                        <p><strong>Total: {{$product->price}}</strong></p>
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
</x-guest-layout>
