@extends('layouts.theme')
@section('content')
<h1>Edit Variant</h1>
<form action="/product_variants/{{ $productVariant->id }}">
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
        <input type="number" class="form-control" name="productVariant_price" value="{{ $productVariant->variant_price}}">
    </div>
    <div class="form-group">
        <label >Quantity</label>
        <input type="number"  class="form-control" name="productVariant_qty" value="{{ $productVariant->variant_qty}}">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
@endsection
