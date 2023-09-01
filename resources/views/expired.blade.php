<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expired</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"  crossorigin="anonymous">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2908437793326427"
            crossorigin="anonymous"></script>
    <style>

        body {
            font-family: Arial, sans-serif;

        }
        .expired-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #EBEEF5;
        }

    </style>
</head>
<body>
<div class="expired-container">
    <!-- Logo and Information -->
    <img src="https://soft-itbd.com/uploads/pPfdJdl0LML9wHXmZxNDgNdYytiJUU-metac09GVC1JVEJELkNPTSAoMSkuZ2lm-.gif" alt="Owner Logo" class="img-fluid" style="max-width: 300px;">
    <h1 class="mt-4">Expired @if($product) ( {{$product->name}} ) @endif</h1>
    <p class="text-muted">Your subscription has expired.</p>

    <!-- Payment Button -->
    @if(!$error)
    <a href="{{route('renew',['pid'=>$pid])}}" class="btn btn-danger">Renew Subscription</a>
    @endif
    <!-- Hotline Information -->
    <div class="mt-4 text-center">
        <p class="text-muted">For assistance, please call our hotline:</p>
        <a href="tel:+8801314961093" class="text-decoration-none"><h2><strong>Hotline: +880 1314 961093</strong></h2></a>
    </div>
</div>
</body>
</html>
