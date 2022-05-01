@extends('master')
@section("content")
<div class="py-3 mb-4 back">
    <div style="padding-bottom: 10px;" class="container">
        <h3 class="mb-0">Home / My Orders</h3>
    </div>
</div>
<div class="custom-product">
    <div class="col-sm-10">
        <div class="trending-wrapper">
            @foreach($orders as $item)
            <div class=" row searched-item cart-list-devider">
                <div class="col-sm-3">
                    <a href="detail/{{$item->id}}">
                        <img class="trending-image" src="{{$item->gallery}}">
                    </a>
                </div>
                <div class="col-sm-4">
                    <div class="">
                        <h3>{{$item->name}}</h3>
                        <h4>Product Quantity : {{$item->quantity}}</h4>
                        <h4>Delivery Status : {{$item->status}}</h4>
                        <h4>Address : {{$item->address}}</h4>
                        <h4>Payment Method : {{$item->payment_method}}</h4>
                        <h4>Payment Status : {{$item->payment_status}}</h4>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection