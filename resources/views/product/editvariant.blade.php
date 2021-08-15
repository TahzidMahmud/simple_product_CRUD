@extends('layouts.theme')
@section('content')
<div class="card-body">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif

    {{-- {{ __('You are logged in!') }} --}}
</div>
<h1>Edit Variant</h1>
<form action="/product_variants/{{ $productVariant->id }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf

    <div class="form-group">
      <label >Size</label>
      <select class="form-control" name="size_id" required >
        <option value="{{ $productVariant->size->id}}" selected>{{ $productVariant->size->name}}</option>
        @foreach ($sizes as $size)
        <option value="{{ $size->id}}" >{{ $size->name}}</option>
        @endforeach
       </select>
    </div>
    <div class="form-group">
      <label >Color</label>
      <select class="form-control" name="color_id" required >
        <option value="{{ $productVariant->color->id}}" selected>{{ $productVariant->color->name}}</option>
        @foreach ($colors as $color)
        <option value="{{ $color->id}}" >{{ $color->name}}</option>
        @endforeach
       </select>
    </div>
    <div class="form-group">
        <label >Price</label>
        <input type="number" class="form-control" name="variant_price" value="{{ $productVariant->variant_price}}">
    </div>
    <div class="form-group">
        <label >Quantity</label>
        <input type="number"  class="form-control" name="variant_qty" value="{{ $productVariant->variant_qty}}">
    </div>

    <div class="row">
        <div class=" form-group col-md-6">
            <label >Current Image</label>
            <img style="height: 7rem;width;7rem;" src="{{ asset('images/products/'.$productVariant->product_id.'/'.$productVariant->variant_image) }}" alt="">
        </div>
        <div class="form-group col-md-6">
            <label >New Image</label>
            <input type="file"  name="variant_image" class="form-control"  value="{{ $productVariant->variant_image}}">
        </div>
    </div>

    <button type="submit" class="btn btn-primary form-control">Update</button>
  </form>
@endsection
