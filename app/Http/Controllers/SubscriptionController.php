<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function check_subscription(Request $request){
        $domain = $request->domain??null;
        $email = $request->email??null;
        $phone = $request->phone??null;
        $product = Product::where('domain', $domain)
            ->where('email', $email)
            ->where('phone', $phone)
            ->first();

        if ($product) {
            if (remainingDays($product->end_date)>0){
                return response()->json([
                    'message' => 'Subscription found and updated',
                    'status' => true,
                    'product' => $product
                ], 200);
            }
            return response()->json([
                'message' => 'Subscription found and expired',
                'status' => false,
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
        return view('expired',$data);
    }
    public function renew($pid){
        $data = array();
        $product =  Product::where('pid',$pid)->first();
        if($product){
            $invoice = Invoice::where('product_id',$product->id)->where('status','!=','success')->first();
            if($invoice){
                $data['pid']= $pid;
                $data['invoice']= $invoice;
                $data['product']= $product;
                $data['user']= $product->user;
                return view('invoice',$data);
            }else{
                $invoice = Invoice::create([
                    'user_id'=>$product->user->id,
                    'product_id'=>$product->id,
                    'amount'=>$product->price,
                    'status'=>'pending',
                    'method'=>'',
                ]);
                $data['pid']= $pid;
                $data['invoice']= $invoice;
                $data['product']= $product;
                $data['user']= $product->user;
                return view('invoice',$data);
            }

        }else{
            $data['pid']= $pid;
            $data['error']= true;
            return view('expired',$data);
        }

    }


}
