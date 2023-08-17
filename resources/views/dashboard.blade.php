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
                    <h1 class="text-lg">Total Products</h1>
                    <h1 class="text-lg">{{auth()->user()->products->count()}}</h1>

                </div>

                <!-- Card 2 -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <h1 class="text-lg">Total Invoices</h1>
                    <h1 class="text-lg">{{auth()->user()->invoices->count()}}</h1>
                </div>

                <!-- Card 3 -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <h1 class="text-lg">Pending Invoices</h1>
                    <h1 class="text-lg">{{auth()->user()->invoices->where('status','pending')->count()}}</h1>
                </div>

                <!-- Card 4 -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <h1 class="text-lg">Paid Invoices</h1>
                    <h1 class="text-lg">{{auth()->user()->invoices->where('status','success')->count()}}</h1>
                </div>

            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
            <div class="table-responsive">
                <h2 class="text-lg font-semibold mb-2">Products List</h2>
                <table class="border-collapse w-full mt-4">
                    <thead>
                    <tr>
                        <th class="border border-gray-300 px-2 py-1">Item</th>
                        <th class="border border-gray-300 px-2 py-1">Description</th>
                        <th class="border border-gray-300 px-2 py-1">Billing</th>
                        <th class="border border-gray-300 px-2 py-1">Price</th>
                        <th class="border border-gray-300 px-2 py-1">Expire Date</th>
                        <th class="border border-gray-300 px-2 py-1">Remaining</th>
                        <th class="border border-gray-300 px-2 py-1">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(auth()->user()->products as $item)
                    <tr>
                        <td class="border border-gray-300 px-2 py-1">{{$item->name}}</td>
                        <td class="border border-gray-300 px-2 py-1">{{$item->description}}</td>
                        <td class="border border-gray-300 px-2 py-1">{{$item->billing}}</td>
                        <td class="border border-gray-300 px-2 py-1">{{$item->price}}</td>
                        <td class="border border-gray-300 px-2 py-1">{{$item->end_date}}</td>
                        <td class="border border-gray-300 px-2 py-1">{{remainingDays($item->end_date)}} Days</td>
                        <td class="border border-gray-300 px-2 py-1"> <a class="btn border px-2 py-1 bg-gray-500 text-white" href="{{route('renew',['pid'=>$item->pid])}}">Extend</a> </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
