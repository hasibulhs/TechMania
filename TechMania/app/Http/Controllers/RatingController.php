<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Rating;

class RatingController extends Controller
{
    public function add(Request $req)
    {
        $stars_rated = $req->input('product_rating');
        $user_id = $req->session()->get('user')['id'];
        $product_id = $req->input('product_id');

        $verified_purchase = Order::where('user_id',$user_id)->where('product_id',$product_id)->get();
        
        if($verified_purchase->count() > 0)
        {
            $existing_rating = Rating::where('user_id', $user_id)->where('prod_id', $product_id)->first();

            if($existing_rating)
            {
                $existing_rating->stars_rated=$stars_rated;
                $existing_rating->update();
            }

            else
            {
                Rating::create([
                    'user_id' => $user_id,
                    'prod_id' => $product_id,
                    'stars_rated' => $stars_rated
                ]);
            }

            return redirect()->back()->with('success','Thank you for rating this product');
        }

        else
        {
            //return redirect()->back()->with('error','You can not rate this product without purchasing');
            return "You can not rate the product without purchasing it.";
        }
    }
}
