@extends('layouts.app')

@section('content')

<div class="container">
    <h3>Book Details</h3>
    <a href="{{route('cart.show')}}" class="btn btn-warning" style="float:right;">Show Cart</a>
    <form action="{{ route('home') }}" method="GET">
      <div class="row">
        <div class="col-3">
        <input type="text" name="search" class="form-control" placeholder="Search by book name">
        </div>
        <div class="col-3">
        <select name="order" class="form-control">
            <option value="high_to_low">Price: High to Low</option>
            <option value="low_to_high">Price: Low to High</option>
        </select>
        </div>
        <div class="col-3">
        <button type="submit" class="btn btn-primary">Search</button>
        </div>
      </div>
    </form>
    <div class="row">
        @foreach($books as $book)
        <div class="col-md-3">
            <div class="card m-2">
                <div class="card-body">
                    <h5 class="card-title"></h5>
                      <p class="card-text">
                        <img src="{{asset('upload/'.$book->image)}}"  hight="200" width="200"  alt='No Image'/><br>
                        Name : {{$book->name}} <br>
                        Price : {{$book->price}} <br>
                        Description : {{$book->description}}<br>
                        <div class="stock_message text-danger"></div>
                     </div>
                    </p>
                    <a href="{{route('cart.add',$book->id)}}" class="btn btn-success buynow text-white">Add to card</a>
                   
                </div>
            </div>
      
        @endforeach
        </div>

        

</div>
        
</div>


</div>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

@endsection
    