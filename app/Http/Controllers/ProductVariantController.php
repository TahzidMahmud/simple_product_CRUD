<?php

namespace App\Http\Controllers;

use App\ProductVariant;
use App\Product;
use App\Size;
use App\color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {

        return view('product.createVariant',compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $validator=Validator::make($request->all(), [
            'product_id' => 'required',
            'size_id'=>'required',
            'color_id'=>'required',
            'variant_price'=>'required',
            'size_id'=>'required',
            'variant_qty'=>'required',
            'variant_image' => 'required|file|image',
        ])->validate();

        $imageName = time().'.'.$request->file('variant_image')->extension();

        $request->file('variant_image')->move(public_path('images/products/'.$request->product_id.'/'), $imageName);
        $variant=ProductVariant::create([
            'product_id' => $request->product_id,
            'size_id'=>$request->size_id,
            'color_id'=>$request->color_id,
            'variant_price'=>$request->variant_price,
            'size_id'=>$request->size_id,
            'variant_qty'=>$request->variant_qty,
            'variant_image' => $imageName,
        ]);

        return response(["message"=>"Created Successfully","variant"=>$variant]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductVariant  $productVariant
     * @return \Illuminate\Http\Response
     */
    public function show(ProductVariant $productVariant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductVariant  $productVariant
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductVariant $productVariant)
    {
        $sizes=Size::all();
        $colors=Color::all();

        return view('product.editvariant',compact('productVariant','sizes','colors'));
    }
    public function edit_variants(Product $product){

        return view('product.editVariants',compact('product'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductVariant  $productVariant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductVariant $productVariant)
    {
        // dd($request);
        $validator=Validator::make($request->all(), [
            'color_id'=>'required',
            'variant_price'=>'required',
            'size_id'=>'required',
            'variant_qty'=>'required',
        ])->validate();
        $imageName=$productVariant->variant_image;
            if( $request->file('variant_image')){
                Storage::delete(public_path('images/products/'.$productVariant->product_id.'/'.$productVariant->variant_image));
                $imageName = time().'.'.$request->file('variant_image')->extension();
                $request->file('variant_image')->move(public_path('images/products/'.$productVariant->product_id.'/'), $imageName);
            }

        $res=$productVariant->update([
            'color_id'=>$request->color_id,
            'variant_price'=>$request->variant_price,
            'size_id'=>$request->size_id,
            'variant_qty'=>$request->variant_qty,
            'variant_image'=>$imageName

        ]);
        return redirect()->back()->with('message', 'Updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductVariant  $productVariant
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductVariant $productVariant)
    {
        //
    }
    public function fetch_variants(Product $product){
            $variants=$product->variants;
            return response(["variants"=>$variants]);
    }
}
