@extends('master')
@section("content")
<div class="container">
    <div class="row">
        <div class="col-sm-6">
        <img class="detail-img" src="{{$product['gallery']}}">
        </div>
        <div class="col-sm-6">
            <a href="/">Go Back</a>
        <h2>{{$product['name']}}</h2>
        <h3>Price: {{$product['price']}}</h3>
        <h4>Details: {{$product['description']}}</h4>
        <h4>Category: {{$product['category']}}</h4>
        @php $ratenum = number_format($rating_value) @endphp
        <div style="font-size: 16px;" class="rating">
            @for($i=1; $i<=$ratenum; $i++)
                <i class="fa fa-star checked"></i>
            @endfor
            @for($i=$ratenum+1; $i<=5; $i++)
                <i class="fa fa-star"></i>
            @endfor
            <span>{{ $ratings->count() }} Rating(s)</span>
        </div>
        <br><br>
        <form action="/add_to_cart" method="POST">
            @csrf
            <input type="hidden" name="product_id" value={{$product['id']}}>
            <button class="btn btn-primary">Add to Cart</button>
        </form>
        <br>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Rate this product</button>
        <br><br>
        </div>
    </div>
</div>

<!--  Modal content --> 
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/add" method="POST">
                @csrf
                <input type="hidden" name="product_id" value={{$product['id']}}>
                <!-- Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Rate {{$product['name']}}</h4>
                </div>
                <!--  Body --> 
                <div class="modal-body">
                    <div class="rating-css">
                        <div class="star-icon">
                            @if($user_rating)
                                @for($i=1; $i<=$user_rating->stars_rated; $i++)
                                    <input type="radio" value="{{$i}}" name="product_rating" checked id="rating{{$i}}">
                                    <label for="rating{{$i}}" class="fa fa-star"></label>
                                @endfor
                                @for($i=$user_rating->stars_rated+1; $i<=5; $i++)
                                    <input type="radio" value="{{$i}}" name="product_rating" id="rating{{$i}}">
                                    <label for="rating{{$i}}" class="fa fa-star"></label>
                                @endfor
                            
                            @else
                                <input type="radio" value="1" name="product_rating" checked id="rating1">
                                <label for="rating1" class="fa fa-star"></label>
                                <input type="radio" value="2" name="product_rating" id="rating2">
                                <label for="rating2" class="fa fa-star"></label>
                                <input type="radio" value="3" name="product_rating" id="rating3">
                                <label for="rating3" class="fa fa-star"></label>
                                <input type="radio" value="4" name="product_rating" id="rating4">
                                <label for="rating4" class="fa fa-star"></label>
                                <input type="radio" value="5" name="product_rating" id="rating5">
                                <label for="rating5" class="fa fa-star"></label>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div> <!-- Footer End -->
            </form>
        </div> <!-- Content end -->
    </div> <!-- Dialog end -->
</div> <!-- Modal end -->
<!--  End modal content --> 

@endsection