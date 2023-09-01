<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Subscription Invoice - {{$invoice->invid}}</title>
    <!-- Add Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2908437793326427"
            crossorigin="anonymous"></script>
    <style>
        p{
            margin: 0;
        }

        body{
            background-color: #EBEEF5;
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
                    <img src="https://soft-itbd.com/uploads/pPfdJdl0LML9wHXmZxNDgNdYytiJUU-metac09GVC1JVEJELkNPTSAoMSkuZ2lm-.gif" class="img-fluid" style="max-width: 250px">
                    <h2 class="card-title mt-2">Product Subscription {{$product->name}}</h2>
                </div>
                <div class="card-body">
                    <!-- Invoice Design -->
                    <h2 class="text-lg font-semibold mb-2">Invoice #{{$invoice->invid}}</h2>
                    <div class=" table-responsive">
                        <table class="table table-bordered table-striped">
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
                                                <input type="submit" id="bKash_button" class="btn  btn-danger"  value="Pay With Bkash">
                                                <img src="data:image/png;base64,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">
                                            </form>

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
                <div class="card-footer">
                    <a href="tel:+8801314961093" class="text-decoration-none"><h2><strong>Hotline: +880 1314 961093</strong></h2></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


