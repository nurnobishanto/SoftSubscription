<?php

use Carbon\Carbon;


function remainingDays($end_date): float|int
{
    $end_date = Carbon::parse($end_date);
    $now = Carbon::now();

    if ($now > $end_date) {
        return -1 * $end_date->diffInDays($now);
    }else{
        return $end_date->diffInDays($now);
    }
}
function completeInvoiceBkash($invid, $amount,$trxID,$paymentID){
    $invoice =  \App\Models\Invoice::where('invid',$invid)->first();
    $invoice->status = 'success';
    $invoice->method = 'Bkash';
    $invoice->trxid = $trxID;
    $invoice->payment_id = $paymentID;
    $invoice->update();

    $product = $invoice->product;

    $product_price = $product->price;
    $product_end_date = $product->end_date;
    $product_billing = $product->billing;
    if ($product_price>=$amount){
        $extended_date = Carbon::parse($product_end_date);
        if ($product_billing == 'daily') {
            $extended_date->addDay();
        } elseif ($product_billing == 'weekly') {
            $extended_date->addWeek();
        } elseif ($product_billing == 'monthly') {
            $extended_date->addMonth();
        } elseif ($product_billing == 'yearly') {
            $extended_date->addYear();
        }
        $product->update(['end_date' => $extended_date]);

    }
}
function nextBillingDate($billing,$date){
    $extended_date = Carbon::parse($date);
    if ($billing == 'daily') {
        $extended_date->addDay();
    } elseif ($billing == 'weekly') {
        $extended_date->addWeek();
    } elseif ($billing == 'monthly') {
        $extended_date->addMonth();
    } elseif ($billing == 'yearly') {
        $extended_date->addYear();
    }
    return $extended_date->format('Y-m-d');
}
function checkSubscription(){
    $apiUrl = 'https://subscription.soft-itbd.com/check-subscription';
    $data = [
        'domain' => $_SERVER['HTTP_HOST'],
    ];

    $ch = curl_init($apiUrl);
    // Set cURL options for POST request
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response instead of outputting it
    curl_setopt($ch, CURLOPT_POST, true); // Set the request method to POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); // Set POST data
    // Add headers or authentication if needed

    $response = curl_exec($ch); // Execute the cURL request

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'cURL error: ' . curl_error($ch);
    } else {
        $responseData = json_decode($response, true); // Decode the JSON response
        curl_close($ch); // Close cURL session

        // Assuming you have a response array named $responseData
        if (isset($responseData['status']) && $responseData['status']) {

            exit;
        }
        else if (isset($responseData['status']) && !$responseData['status'] && isset($responseData['product'])) {
            header('Location: https://subscription.soft-itbd.com/expired/'.$responseData['product']['pid']); // Replace with your desired redirect URL
            exit; // Terminate script execution
        }
        else {
            // Subscription is not active, redirect to another website URL
            header('Location: https://subscription.soft-itbd.com/expired/0'); // Replace with your desired redirect URL
            exit; // Terminate script execution
        }
    }

}
