@extends('layouts.theme')
@section('content')

<div class="row">
    <a class="btn btn-success m-4" href="{{ route('products.create') }}">+ Add New Product</a>
</div>
    <div class="row">
        @forelse ($products as $product)
            <div class="col-md-4"></div>
            <div class="card m-4" style="width: 30rem;">
                <div class="card-body">
                <h5 class="card-title">{{ $product->product_name }}</h5>
                @if($product->product_brand!="")
                <h6 class="card-subtitle mb-2 text-muted">Brand : {{ $product->product_brand }}</h6>
                @endif
                <p class="card-text">{{ $product->product_description }}</p><hr>
                <h6>Variants : {{ $product->variants->count() }}</h6>
                    @forelse ($product->variants as $variant)
                        <div class="d-flex justify-content-between">
                            <span class="m-2">{{ $variant->size->name }} - {{ $variant->color->name }} </span><span class="m-2">Price : {{ $variant->variant_price}}</span><span class="m-2">Quantity : {{ $variant->variant_qty}}</span>
                        </div>
                    @empty

                    @endforelse

                <a href="{{ route('products.edit',$product->id) }}" class="btn btn-primary">Edit Product</a>
                <a href="{{ route('product.variants.edit',$product->id) }}" class="btn btn-secondary">Edit Variants</a>
                <a href="{{ route('product.variants.create',$product->id) }}" class="btn btn-success">Create A Variant</a>

                </div>
            </div>
        @empty
            <h1 class="text-danger">No Products..!!</h1>
        @endforelse
    </div>
@endsection
