<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Rating;
use Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Dompdf\Dompdf;

class ProductController extends Controller
{
    function index()
    {
        $data= Product::all();
        return view('product',['products'=>$data]);
    }

    function detail(Request $req, $id)
    {
        if($req->session()->has('user'))
        {
            $product = Product::find($id);
            $ratings = Rating::where('prod_id', $id)->get();
            $rating_sum = Rating::where('prod_id', $id)->sum('stars_rated');
            
            if($ratings->count())
            {
                $rating_value = $rating_sum/$ratings->count();
            }

            else
            {
                $rating_value = 0;
            }
            
            $user_id = $req->session()->get('user')['id'];
            $user_rating = Rating::where('prod_id', $id)->where('user_id',$user_id)->first();

            return view('detail',compact('product','ratings','rating_value','user_rating'));
        }

        else
        {
            return "You need to login first.";
        }
    }

    function search(Request $req)
    {
        //return $req->input();
        $data= Product::where('name','like','%'.$req->input('query').'%')->get();
        return view('search',['products'=>$data]);
    }

    public function addToCart(Request $req)
    {
        if($req->session()->has('user'))
        {
            $ct= DB::table('cart')
            ->where('product_id', $req->product_id)
            ->where('user_id', $req->session()->get('user')['id'])
            ->first();

            if(!$ct)
            {
                $cart= new Cart;
                $cart->user_id=$req->session()->get('user')['id'];
                $cart->product_id=$req->product_id;
                $cart->quantity=1;
                $cart->price=$req->product_price;
                $cart->save();
            }

            else
            {
                $qty = $ct->quantity + 1;
                $price = $ct->price;
                $i = $ct->id;
                
                $temp = Cart::find($i);
                $temp->quantity = $qty;
                $temp->price = $price + $req->product_price;
                $temp->save();
            }

            return redirect('/');
        }

        else
        {
            return redirect('/login');
        }
    }
    public function addCart(Request $req) //extra
    {
        if($req->session()->has('user'))
        {
           $cart= new Cart;
           $cart->user_id=$req->session()->get('user')['id'];
           $cart->product_id=$req->product_id;
           $cart->quantity=1;
           $cart->save();
           return redirect('/');
        }

        else
        {
            return redirect('/login');
        }
    }

    static function cartItem()
    {
        $userId=Session::get('user')['id'];
        return Cart::where('user_id',$userId)->count();
    }

    function cartList(Request $req)
    {
        if($req->session()->has('user'))
        {
            $userId=Session::get('user')['id'];
            
            $cart = DB::table('cart')
            ->where('cart.user_id',$userId)
            ->select('cart.*')
            ->get();

            $products= DB::table('cart')
            ->join('products','cart.product_id','=','products.id')
            ->where('cart.user_id',$userId)
            ->select('products.*','cart.*','cart.id as cart_id','products.price as products_price')
            ->get();

            return view('cart',compact('products','cart'));
        }

        else
        {
            return "You need to login first.";
        }
    }

    function removeCart($id)
    {
        Cart::destroy($id);
        return redirect('cartlist');
    }

    function orderNow()
    {
        /*$userId=Session::get('user')['id'];
        
        $total= $products= DB::table('cart')
        ->join('products','cart.product_id','=','products.id')
        ->where('cart.user_id',$userId)
        ->sum('products.price');
 
        return view('ordernow',['total'=>$total]);*/
        
        $userId=Session::get('user')['id'];
        
        $products= DB::table('cart')
        ->join('products','cart.product_id','=','products.id')
        ->where('cart.user_id',$userId)
        ->select('products.*','cart.*','cart.id as cart_id','products.price as products_price')
        ->get();

        return view('order',['products'=>$products]);
    }

    function orderPlace(Request $req)
    {
        $userId=Session::get('user')['id'];
        $allCart= Cart::where('user_id',$userId)->get();
        
        foreach($allCart as $cart)
        {
            //dd($cart['price']);
            $order= new Order;

            $order->product_id=$cart['product_id'];
            $order->quantity=$cart['quantity'];
            
            $temp=$cart['price'];
            $temp=$temp+60+($temp/15);

            $order->price=$temp;
            $order->user_id=$cart['user_id'];
            $order->status="Pending";
            $order->payment_method=$req->payment;
            $order->payment_status="Pending";
            $order->address=$req->address;
            $order->save();
            
            Cart::where('user_id',$userId)->delete(); 
        }

        $req->input();
        return redirect('/');
    }

    function myOrders(Request $req)
    {
        if($req->session()->has('user'))
        {
            $userId=Session::get('user')['id'];
            
            $orders= DB::table('orders')
            ->join('products','orders.product_id','=','products.id')
            ->where('orders.user_id',$userId)
            ->select('orders.*','products.*','orders.id as orders_id','orders.price as orders_price')
            ->get();

            $od = DB::table('orders')
            ->where('orders.user_id',$userId)
            ->select('orders.*')
            ->get();
    
            return view('myorders',compact('orders','od'));
        }

        else
        {
            return "You need to login first.";
        }
    }

    public function changeQty(Request $req, $id)
    {
        $data= Cart::find($id);
        
        $p=Product::where('id',$data->product_id)->first();
        $price=$p['price'];
        
        if($req->change_to === 'down')
        {
            if($data->quantity > 1)
            {
                $qty = $data->quantity - 1;
                $data->quantity = $qty;

                $data->price = $price * $qty;

                $data->save();
            }
                
            else
            {
                Cart::destroy($id);
            }
        }
        
        else
        {
            $qty = $data->quantity + 1;
            $data->quantity = $qty;

            $data->price = $price * $qty;

            $data->save();
        }

        return back();
    }

    public function invoice($id)
    {
        $orderDetails = Order::where('id',$id)->first()->toArray();
        $userDetails = User::where('id',$orderDetails['user_id'])->first()->toArray();
        $prod = Product::where('id',$orderDetails['product_id'])->first()->toArray();
        //dd($prod);

        $subTotal = ($orderDetails['quantity']*$prod['price'])/15;

        $output =   '<!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="utf-8">
                        <title>Example 2</title>
                        <style>
                            @font-face
                            {
                                font-family: SourceSansPro;
                                src: url(SourceSansPro-Regular.ttf);
                            }
                            
                            .clearfix:after
                            {
                                content: "";
                                display: table;
                                clear: both;
                            }
                            
                            a
                            {
                                color: #0087C3;
                                text-decoration: none;
                            }
                            
                            body
                            {
                                position: relative;
                                width: 21cm;  
                                height: 29.7cm; 
                                margin: 0 auto; 
                                color: #555555;
                                background: #FFFFFF; 
                                font-family: Arial, sans-serif; 
                                font-size: 14px; 
                                font-family: SourceSansPro;
                            }
                            
                            header
                            {
                                padding: 10px 0;
                                margin-bottom: 20px;
                                border-bottom: 1px solid #AAAAAA;
                            }
                            
                            #logo
                            {
                                float: left;
                                margin-top: 8px;
                            }
                            
                            #logo img
                            {
                                height: 70px;
                            }
                            
                            #company
                            {
                                float: right;
                                text-align: right;
                            }
                            
                            
                            #details
                            {
                                margin-bottom: 50px;
                            }
                            
                            #client
                            {
                                padding-left: 6px;
                                border-left: 6px solid #0087C3;
                                float: left;
                            }
                            
                            #client .to
                            {
                                color: #777777;
                            }
                            
                            h2.name
                            {
                                font-size: 1.4em;
                                font-weight: normal;
                                margin: 0;
                            }
                            
                            #invoice
                            {
                                float: right;
                                text-align: right;
                            }
                            
                            #invoice h1
                            {
                                color: #0087C3;
                                font-size: 2.4em;
                                line-height: 1em;
                                font-weight: normal;
                                margin: 0  0 10px 0;
                            }
                            
                            #invoice .date
                            {
                                font-size: 1.1em;
                                color: #777777;
                            }
                            
                            table
                            {
                                width: 100%;
                                border-collapse: collapse;
                                border-spacing: 0;
                                margin-bottom: 20px;
                            }
                            
                            table th,
                            table td
                            {
                                padding: 20px;
                                background: #EEEEEE;
                                text-align: center;
                                border-bottom: 1px solid #FFFFFF;
                            }
                            
                            table th
                            {
                                white-space: nowrap;        
                                font-weight: normal;
                            }
                            
                            table td
                            {
                                text-align: right;
                            }
                            
                            table td h3
                            {
                                color: #57B223;
                                font-size: 1.2em;
                                font-weight: normal;
                                margin: 0 0 0.2em 0;
                            }
                            
                            table .no
                            {
                                color: #FFFFFF;
                                font-size: 1.6em;
                                background: #57B223;
                            }
                            
                            table .desc
                            {
                                text-align: left;
                            }
                            
                            table .unit
                            {
                                background: #DDDDDD;
                            }
                            
                            table .qty
                            {
                            }
                            
                            table .total
                            {
                                background: #57B223;
                                color: #FFFFFF;
                            }
                            
                            table td.unit,
                            table td.qty,
                            table td.total
                            {
                                font-size: 1.2em;
                            }
                            
                            table tbody tr:last-child td
                            {
                                border: none;
                            }
                            
                            table tfoot td
                            {
                                padding: 10px 20px;
                                background: #FFFFFF;
                                border-bottom: none;
                                font-size: 1.2em;
                                white-space: nowrap; 
                                border-top: 1px solid #AAAAAA; 
                            }
                            
                            table tfoot tr:first-child td
                            {
                                border-top: none; 
                            }
                            
                            table tfoot tr:last-child td
                            {
                                color: #57B223;
                                font-size: 1.4em;
                                border-top: 1px solid #57B223; 
                            }
                            
                            table tfoot tr td:first-child
                            {
                                border: none;
                            }
                            
                            #thanks
                            {
                                font-size: 2em;
                                margin-bottom: 50px;
                            }
                            
                            #notices
                            {
                                padding-left: 6px;
                                border-left: 6px solid #0087C3;  
                            }
                            
                            #notices .notice
                            {
                                font-size: 1.2em;
                            }
                            
                            footer
                            {
                                color: #777777;
                                width: 100%;
                                height: 30px;
                                position: absolute;
                                bottom: 0;
                                border-top: 1px solid #AAAAAA;
                                padding: 8px 0;
                                text-align: center;
                            }                          
                        </style>
                    </head>
                    <body>
                        <header class="clearfix">
                            <div id="logo">
                                <h1>ORDER INVOICE</h1>
                            </div>
                        </header>
                        <main>
                            <div id="details" class="clearfix">
                                <div id="client">
                                    <div class="to">INVOICE TO:</div>
                                    <h2 class="name">'.$userDetails['first_name'].' '.$userDetails['last_name'].'</h2>
                                    <div class="address">'.$orderDetails['address'].'</div>
                                    <div class="email"><a href="mailto:'.$userDetails['email'].'">'.$userDetails['email'].'</a></div>
                                </div>
                                <div style="float:right;">
                                    <h1>#Order_ID_'.$orderDetails['id'].'</h1>
                                    <div class="date">Order Date: '.date('d-m-Y',strtotime($orderDetails['created_at'])).'</div>
                                    <div class="date">Order Status: '.$orderDetails['status'].'</div>
                                    <div class="date">Payment Method: '.$orderDetails['payment_method'].'</div>
                                </div>
                            </div>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <thead>
                                    <tr>
                                        <th class="no">#</th>
                                        <th class="desc">PRODUCT</th>
                                        <th class="unit">UNIT PRICE</th>
                                        <th class="qty">QUANTITY</th>
                                        <th class="total">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="no">01</td>
                                        <td class="desc"><h3>'.$prod['name'].'</h3>'.$prod['description'].'</td>
                                        <td class="unit">Tk '.$prod['price'].'</td>
                                        <td class="qty">'.$orderDetails['quantity'].'</td>
                                        <td class="total">Tk '.$prod['price']*$orderDetails['quantity'].'</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">TAX 15%</td>
                                        <td>Tk '.$subTotal.'</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">Delivery Charge</td>
                                        <td>Tk 60</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">GRAND TOTAL</td>
                                        <td>Tk '.$orderDetails['price'].'</td>
                                    </tr>
                                </tfoot>
                            </table>
                            <br>
                            <div id="thanks">Thank you for your purchase!</div>
                            <div id="notices">
                                <div>NOTICE:</div>
                                <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                            </div>
                        </main>
                        <footer>
                        This invoice was created on a computer and is valid without the signature and seal.
                        </footer>
                    </body>
                    </html>';

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($output);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
    }
}