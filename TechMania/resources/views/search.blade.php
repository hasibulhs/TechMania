@extends('master')
@section("content")
<div class="py-3 mb-4 back">
    <div style="padding-bottom: 10px;" class="container">
        <h3 class="mb-0">Home / Searched Items</h3>
    </div>
</div>
<div class="custom-product">
     <div class="col-sm-4">
     </div>
     <div class="col-sm-4">
        <div class="trending-wrapper">
            <br><br>
            @foreach($products as $item)
            <div class="searched-item">
              <a href="detail/{{$item['id']}}">
              <img class="trending-image" src="{{$item['gallery']}}">
              <div class="">
                <h2>{{$item['name']}}</h2>
                <h5>{{$item['description']}}</h5>
              </div>
            </a>
            </div>
            <hr>
            @endforeach
          </div>
     </div>
</div>
@endsection