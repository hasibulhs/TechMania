@extends('master')
@section('content')
<div class="py-3 mb-4 back">
    <div style="padding-bottom: 10px;" class="container">
        <h3 class="mb-0">Home / Cart List</h3>
    </div>
</div>

<div class="container">
    <div class="row">
        @if($cart->count() > 0)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="50%">Product</th>
                        <th width="10%">Price</th>
                        <th width="8%">Quantity</th>
                        <th width="22%">Sub Total</th>
                        <th width="10%"></th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($products as $item)
                    @php
                        $sub_total = $item->products_price * $item->quantity;
                        $total += $sub_total;
                    @endphp
                        <tr>
                            <td>
                                <img
                                    src="{{$item->gallery}}"
                                    alt="{{$item->name}}"
                                    class="img-fluid"
                                    width="150"
                                >
                                <span>{{$item->name}}</span>
                            </td>
                            <td>৳ {{$item->products_price}}</td>
                            <td>
                                <form action="/change-qty/{{$item->cart_id}}" class="box">
                                    <button
                                        type="submit"
                                        value="down"
                                        name="change_to"
                                        class="btn btn-danger"
                                    >
                                        @if($item->quantity === 1) x @else - @endif
                                    </button>
                                    <input
                                        type="number"
                                        value="{{$item->quantity}}"
                                        disabled
                                    >
                                    <button
                                        type="submit"
                                        value="up"
                                        name="change_to"
                                        class="btn btn-success"
                                    >
                                        +
                                    </button>
                                </form>
                            </td>
                            <td>৳ {{$sub_total}}</td>
                            <td>
                                <a href="/removecart/{{$item->cart_id}}" class="btn btn-danger"><i class="fa fa-trash"></i> Remove From Cart</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td>
                            <a class="btn btn-success button3" href="ordernow">Checkout</a>
                        </td>
                    </tr>
                </tfoot>
            </table>
        @else
            <div class="card-body text-center">
                <h2>Your <i class="fa fa-shopping-cart"></i> Cart is empty</h2>
            </div>
        @endif
    </div>
</div>
<br><br><br>
@endsection