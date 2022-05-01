@extends('master')
@section("content")
<div class="py-3 mb-4 back">
    <div style="padding-bottom: 10px;" class="container">
        <h3 class="mb-0">Home / My Orders</h3>
    </div>
</div>
<br>

<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            @if($od->count() > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Ordered Product</th>
                            <th>Quantity</th>
                            <th>Ordered Amount</th>
                            <th>Order Status</th>
                            <th>Payment Method</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @foreach($orders as $item)
                    <tbody>
                            <td>{{$item->orders_id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->orders_price}}</td>
                            <td>{{$item->status}}</td>
                            <td>{{$item->payment_method}}</td>
                            <td>
                                <a title="Invoice PDF" href="/invoice/{{$item->orders_id}}"><i class="fa fa-file-pdf-o"></i></a>
                            </td>
                    </tbody>
                    @endforeach
                </table>
            @else
                <div class="card-body text-center">
                    <h2>Nothing in your <i class="fa fa-list-ul"></i> Ordered list</h2>
                </div>
            @endif
        </div>
    </div>
</div>
<br><br><br>

@endsection