@extends('master')
@section("content")
<div class="custom-product">
    <div class="col-sm-10">
        <table class="table">
            <tbody>
                <tr>
                    <td>Amount</td>
                    <td>৳ {{$total}}</td>
                </tr>
                <tr>
                    <td>Tax (15%)</td>
                    <td>৳ {{$total/15}}</td>
                </tr>
                <tr>
                    <td>Delivery Charge</td>
                    <td>৳ 60</td>
                </tr>
                <tr>
                    <td>Total Amount</td>
                    <td>৳ {{$total+60+($total/15)}}</td>
                </tr>
            </tbody>
        </table>
        <div>
            <form action="/orderplace" method="POST">
              @csrf
                <div class="form-group">
                    <textarea name="address" placeholder="Enter Your Address" class="form-control" ></textarea>
                </div>
                <div class="form-group">
                <br><label for="pwd">Payment Method</label> <br> <br>
                    <input type="radio" value="cash" name="payment"> <span>Payment on Delivery</span> <br> <br>
                </div>
                <button type="submit" class="btn btn-primary">Order Now</button>
            </form>
        </div>
    </div>
</div>
@endsection