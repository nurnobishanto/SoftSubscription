<?php

namespace App\Http\Controllers;

use App\Models\CheckSubscription;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function check_subscription(Request $request){
        $domain = $request->domain??null;
        $email = $request->email??null;
        $phone = $request->phone??null;

        CheckSubscription::create([
            'domain' => $domain,
            'email' => $email,
            'phone' => $phone,
        ]);
        $product = Product::where('domain', $domain)
            ->orWhere('email', $email)
            ->orWhere('phone', $phone)
            ->first();

        if ($product) {
            if (remainingDays($product->end_date)>=0){
                return response()->json([
                    'message' => 'Subscription found and updated',
                    'status' => true,
                    'remaining' => remainingDays($product->end_date),
                    'product' => $product
                ], 200);
            }
            return response()->json([
                'message' => 'Subscription found and expired',
                'status' => false,
                'remaining' => remainingDays($product->end_date),
                'product' => $product
            ], 200);

        } else {
            return response()->json([
                'message' => 'No subscription found',
                'status' => false,
            ], 404);
        }
    }
    public function expired($pid){
        $data = array();
        $data['error']= false;
        $data['pid']= $pid;
        $data['product']= Product::where('pid',$pid)->first();
        return view('expired',$data);
    }
    public function renew($pid){
        $data = array();
        $product =  Product::where('pid',$pid)->first();
        if($product){
            $invoice = Invoice::where('product_id',$product->id)->where('status','!=','success')->first();
            $product_price = $product->price;
            $extra_percentage = 1.85; // 1.8% extra
            $extra_amount = round(($product_price * $extra_percentage) / 100);
            if($invoice){
                $invoice->amount = $product->price+$extra_amount;
                $invoice->update();
                $data['pid']= $pid;
                $data['extra_amount']= $extra_amount;
                $data['invoice']= $invoice;
                $data['product']= $product;
                $data['user']= $product->user;
                return view('invoice',$data);
            }else{
                $invoice = Invoice::create([
                    'user_id'=>$product->user->id,
                    'product_id'=>$product->id,
                    'amount'=>$product->price+$extra_amount,
                    'status'=>'pending',
                    'method'=>'',
                ]);
                $data['pid']= $pid;
                $data['extra_amount']= $extra_amount;
                $data['invoice']= $invoice;
                $data['product']= $product;
                $data['user']= $product->user;
                return view('invoice',$data);
            }

        }else{
            $data['pid']= $pid;
            $data['error']= true;
            $data['product']= Product::where('pid',$pid)->first();
            return view('expired',$data);
        }

    }


}
