@extends('layouts.theme')
@section('content')

{{-- <edit-variant :p_id="{{ $product->id }}"></edit-variant> --}}
<table class="table">
    <thead>
        <tr>
        <th scope="col">Size</th>
        <th scope="col">Color</th>
        <th scope="col">Price</th>
        <th scope="col">quantity</th>
        <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($product->variants as $variant)
        <form>
            <tr>
                <td>{{ $variant->size->name}}</td>
                <td>{{ $variant->color->name}}</td>
                <td>{{ $variant->variant_price}}</td>
                <td>{{ $variant->variant_qty}}</td>
                <td><a href="{{ route('product_variants.edit', $variant->id) }}" class="btn btn-primary">Edit</a></td>
            </tr>
        </form>
        @empty

        @endforelse

    </tbody>
    </table>


@endsection
