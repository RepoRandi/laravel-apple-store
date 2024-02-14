<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::when($request->input('name'), function ($query, $name) {
            return $query->where('name', 'like', '%' . $name . '%');
        })
            ->with('category')
            ->paginate(5);

        return view('pages.product.index', compact('products'), ['type_menu' => '']);
    }

    public function create()
    {
        $categories = Category::all();
        return view('pages.product.create', compact('categories'), ['type_menu' => '']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'weight' => 'required|numeric|min:0.1',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = (int) $request->price;
        $product->stock = (int) $request->stock;
        $product->weight = $request->weight;
        $product->category_id = $request->category_id;
        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/products', $filename);
            $product->image = $filename;
        }
        $product->save();

        return redirect()->route('product.index')->with('success', 'Product created successfully');
    }

    public function show($id)
    {
        return view('pages.dashboard', ['type_menu' => '']);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('pages.product.edit', compact('product', 'categories'), ['type_menu' => '']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'string|max:255',
            'price' => 'numeric',
            'stock' => 'integer',
            'weight' => 'numeric|min:0.1',
            'category_id' => 'exists:categories,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            Storage::delete('public/products/' . $product->image);
            $filename = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/products', $filename);
            $data = $request->except('image');
            $data['image'] = $filename;
            $product->update($data);
        } else {
            $product->update($request->all());
        }

        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }


    public function destroy($id)
    {
        $product = product::findOrFail($id);
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product deleted successfully');
    }
}
