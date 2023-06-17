@extends('layouts.app')
@section('content')

<div class="row d-flex justify-content-center">

        <div class="col-md-3">
            <div class="card m-2 "><h3 class="m-3" >Add To Cart</h3>
                <div class="card-body" >
                @foreach($carts as $cart)
                      <p class="card-text">
                        <img src="{{asset('upload/'.$cart->book->image)}}"  hight="200" width="200"  alt='No Image'/><br>
                        Name : {{$cart->book->name}} <br>
                        Price : {{$cart->book->price}} <br>
                        Description : {{$cart->book->description}}<br>

                        @endforeach
                     </div>
                    </p>
                    Total:{{$total}}
                    <a href="" class="btn btn-warning" style="float:right;">Checkout</a>
                   
                </div>
            </div>
      
      
        </div>


@endsection