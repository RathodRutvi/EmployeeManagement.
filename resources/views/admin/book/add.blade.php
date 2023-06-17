@extends('layouts.app')

@section('content')
<style>
    .error{
        color:red;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Category') }}
                <a href="{{route('book.index')}}" class="btn btn-primary" style="float:right;">Back</a>

                </div>

                <div class="card-body">
                    <form action="{{route('book.store')}}" method="post" id="bookForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="" placeholder="Enter Name">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Desciption</label>
                            <textarea type="text" class="form-control" name="description" id="" placeholder="Enter Description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">price</label>
                            <input type="text" class="form-control" name="price" id="price" name="price" placeholder="Enter Price">
                        </div>
                        <div class="mb-3">
                           <label for="category" class="form-label">Category</label>
                           <select name="category_id[]"  placeholder="Select options"  class="form-control select2" multiple="multiple">
                           <option value="" disabled>Select Category</option>
                            @foreach($categories as $category)
                             <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Upload Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
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
      $("#bookForm").validate({
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
        image: {
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
        image: {
          required: "image is a required field"
        },
          },

          errorPlacement: function(error, element) {
                    $(element).parent('div').append(error[0]);
                }
      });
});
</script>
@endpush