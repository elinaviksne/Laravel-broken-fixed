<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create() {
        return view('products.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|unique:products|max:255',
            'quantity' => 'required|integer',
            'description' => 'required',
        ]);

        $product = Product::create($validated);

        return redirect()
                ->route('products.show', [$product]) 
                ->with('message', "Product created successfully");
    }

    public function show(Product $product) {
        return view('products.show', compact('product'));
    }

    public function destroy(Product $product) {
        $product->delete();
        return redirect()
                ->route('products.index')
                ->with('message', "Product deleted successfully");
    }

    public function edit(Product $product) {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product) {
        $validated = $request->validate([
            'name' => 'required|unique:products|max:255',
            'quantity' => 'required|integer',
            'description' => 'required',
        ]);

        $product->update($validated);
        return redirect()
                ->route('products.show', [$product])
                ->with('message', "Product updated successfully");

        $tags = json_decode($request->tags, true) ?? [];
        $tagIds = [];

        foreach ($tags as $tag) {
            $t = Tag::firstOrCreate(['name' => $tag['name']]);
            $tagIds[] = $t->id;
        }

        $product->tags()->sync($tagIds);

    }

   public function increase(Product $product)
    {
        $product->increaseQuantity();

        return response()->json([
            'quantity' => $product->quantity,
            'message' => 'Produkts palielināts par 1 vienību.'
        ]);
    }


    public function decrease(Product $product)
    {
        $product->decreaseQuantity();

        return response()->json([
            'quantity' => $product->quantity,
            'message' => 'Produkts samazināts par 1 vienību.'
        ]);
    }

}
