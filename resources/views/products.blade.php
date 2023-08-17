<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <div class="table-responsive sm:max-w-full overflow-x-auto">
                    <h2 class="text-lg font-semibold mb-2">Products List</h2>
                    <table class="border-collapse w-full mt-4">
                        <thead>
                        <tr>
                            <th class="border border-gray-300 px-2 py-1" style="width: 20%">Item</th>
                            <th class="border border-gray-300 px-2 py-1" style="width: 30%">Description</th>
                            <th class="border border-gray-300 px-2 py-1" style="width: 10%">Billing</th>
                            <th class="border border-gray-300 px-2 py-1" style="width: 10%">Price</th>
                            <th class="border border-gray-300 px-2 py-1" style="width: 10%">Expire Date</th>
                            <th class="border border-gray-300 px-2 py-1" style="width: 10%">Remaining</th>
                            <th class="border border-gray-300 px-2 py-1" style="width: 10%">Action</th>
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
                                <td class="border border-gray-300 px-2 py-2">
                                    <a class="btn border px-2 py-1 text-white " href="{{route('renew',['pid'=>$item->pid])}}" style="background-color: green">Extend</a>
                                    <p style="margin: 0px;line-height: 15px">-----------</p>
                                    <a class="btn border px-2 py-1 bg-red-500 text-white" href="{{route('invoices',['pid'=>$item->pid])}}">Invoices</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>


</x-app-layout>
