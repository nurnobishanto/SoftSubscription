<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$product->name}} Invoices
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-2">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
            <div class="table-responsive">
                <h2 class="text-lg font-semibold mb-2">Invoice List</h2>
                <table class="border-collapse w-full mt-4">
                    <thead>
                    <tr>
                        <th class="border border-gray-300 px-2 py-1">INVID</th>
                        <th class="border border-gray-300 px-2 py-1">Amount</th>
                        <th class="border border-gray-300 px-2 py-1">Method</th>
                        <th class="border border-gray-300 px-2 py-1">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($invoices as $item)
                    <tr>
                        <td class="border border-gray-300 px-2 py-1">{{$item->invid}}</td>
                        <td class="border border-gray-300 px-2 py-1">{{$item->amount}}</td>
                        <td class="border border-gray-300 px-2 py-1">{{$item->method}}</td>
                        @if($item->status=='success')
                        <td class="border border-gray-300 px-2 py-1">Paid</td>
                        @else
                            <td class="border border-gray-300 px-2 py-1">
                                <form action="{{ route('url-create') }}" method="POST">
                                    @csrf
                                    <input type="text" value="{{$item->amount}}" id="amount" name="amount" style="display: none">
                                    <input type="text" value="{{$item->invid}}" id="invid" name="invid" style="display: none">
                                    <input type="submit" id="bKash_button" class="px-4 py-2  text-white rounded-md" style="background-color: red" value="Pay With bKash">
                                </form>
                            </td>

                        @endif
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</x-app-layout>
