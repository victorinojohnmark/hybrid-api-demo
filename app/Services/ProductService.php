<?php

namespace App\Services;

use Illuminate\Http\Request;

use App\Models\Product;

class ProductService
{
    public function index(Request $request)
    {
        $product = Product::latest()->get();

        return $product;
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function create($request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

            // Rename and store the file in the public/images directory
            $data['image_filename'] = $image->storeAs('images', $imageName, 'public');
        }
        $product = Product::create($data);

        return $product;
    }

    public function update($request, Product $product)
    {
        $product->fill($request->validated());
        $product->save();

        return $product;
    }

    public function destroy(Product $product)
    {

    }

}
