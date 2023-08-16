<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Subscription Invoice - {{$invoice->invid}}</title>
    <!-- Add Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        p{
            margin: 0;
        }
    </style>
</head>
<body>

<!-- Main Content -->
<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header text-center">
                    <img src="https://soft-itbd.com/uploads/pPfdJdl0LML9wHXmZxNDgNdYytiJUU-metac09GVC1JVEJELkNPTSAoMSkuZ2lm-.gif" class="img-fluid">
                    <h2 class="card-title">Product Subscription</h2>
                </div>
                <div class="card-body">
                    <!-- Invoice Design -->
                    <h2 class="text-lg font-semibold mb-2">Invoice</h2>
                    <table class="table table-bordered">
                        <tr>
                            <th>Bill To:</th>
                            <th>Product Information:</th>
                        </tr>
                        <tr>
                            <td>
                                <p>{{$user->first_name}} {{$user->last_name}}</p>
                                <p>{{$user->email}}, {{$user->phone}}</p>
                                <p>{{$user->address}}, {{$user->zip_code}}</p>
                                <p>{{$user->city}}, {{$user->state}}, {{$user->country}}</p>
                            </td>
                            <td>
                                <p>Product Name : {{$product->name}}</p>
                                <p>Billing : {{$product->billing}}</p>
                                <p>Amount : {{$product->price}}</p>
                                <p>Purchased : {{$product->start_date}}</p>
                                <p>Expired : {{$product->end_date}}</p>
                            </td>
                        </tr>
                        <tr>
                            <th>Next Expire (After Payment)</th>
                            <th>{{nextBillingDate($product->billing,$product->end_date) }}</th>
                        </tr>
                        <tr>
                            <td>
                                <!-- Pay Now Button -->
                                @if($invoice->status!='success')
                                    <div class="mt-4 text-right">
                                        <form action="{{ route('url-create') }}" method="POST">
                                            @csrf
                                            <input type="text" value="{{$invoice->amount}}" id="amount" name="amount" style="display: none">
                                            <input type="text" value="{{$invoice->invid}}" id="invid" name="invid" style="display: none">
                                            <input type="submit" id="bKash_button" class="px-4 py-2  text-white rounded-md" style="background-color: green" value="Pay With bKash">
                                        </form>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <p><strong>Total: {{$product->price}}</strong></p>
                                <p><strong>Payment Charge: {{$extra_amount}}</strong></p>
                                <p><strong>Net Pay: {{$invoice->amount}}</strong></p>
                                <p><strong>Status: {{$invoice->status}}</strong></p>
                            </td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


