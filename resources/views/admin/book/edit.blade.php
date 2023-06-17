@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Product List') }}</div>
                <div class="card-body">
                    <form action="{{route('book.update',$book->id)}}" id="editbookForm" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$book->name}}">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control">{{$book->description}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">price</label>
                            <input type="text" class="form-control" id="price" name="price" value="{{$book->price}}">
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                           <select name="category_id[]" class="form-control select2" multiple="multiple">
                           <option value="" disabled>Select Category</option>
                            @foreach($categories as $category)
                             <option value="{{$category->id}}" @if(in_array($category->id,explode(',',$book->category_id))) selected  @endif>{{$category->name}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Upload Image</label>
                            <input type="file" name="image" class="form-control" value="{{$book->image}}">
                            <img src="{{asset('upload/'.$book->image)}}" style="width: 100px;"/>
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
$(document).ready(function() {
    $('.select2').select2();
});

$(function() {
      $("#editbookForm").validate({
      rules: {
        name: {
          required: true
        },
        description: {
          required: true
        },
        price: {
          required: true
        },
        'category_id[]': {
          required: true
        },
       
      },
      messages: {
        name: {
          required: "Book Name is a required field"
        },
        description: {
          required: "Description is a required field"
        },
        price: {
          required: "Price is a required field"
        },
        'category_id[]': {
          required: "Category is a required field"
        },
          },

          errorPlacement: function(error, element) {
                    $(element).parent('div').append(error[0]);
                }
      });
});

</script>


@endpush