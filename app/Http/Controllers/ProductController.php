<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;



use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function search(request $request){
        $search = $request->input('search')??"";
        $products = Product::where("name","like","%$search%")
        ->orWhere("product_id","like","%$search%")
        ->orWhere("description","like","%$search%")
        ->orWhere("price","like","%$search%")->paginate(5);
        
        return view("products.index",compact("products"));
    }

    public function index(request $request)  {

    $query = Product::query();

    $sort = $request->input('sort', 'name'); 
    $direction = $request->input('direction', 'asc'); 

    $allowedSorts = ['name', 'price'];
    $allowedDirections = ['asc', 'desc'];

    if (in_array($sort, $allowedSorts) && in_array($direction, $allowedDirections)) {
        $query->orderBy($sort, $direction);
    }
    $products = $query->paginate(5);

    return view('products.index', compact('products', 'sort', 'direction'));

    }

    public function create(request $request){
        return view("products.create");
        
    }
    public function store(request $request){
      
        $request->validate([
            'product_id' => 'required',
            'name' => 'required',
            'description' => 'nullable|string',
            'price' => 'required',
            'stock' => 'nullable',
            'image' => 'nullable',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
     }

   public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

        public function update(Request $request, $id)
    {
        $request->validate([
           'product_id' => 'nullable',
            'name' => 'nullable',
            'description' => 'nullable|string',
            'price' => 'nullable',
            'stock' => 'nullable|numeric',
            'image' => 'nullable',
        ]);

        $product = Product::findOrFail($id);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }


    public function show(request $request,$id){
        $product = Product::findOrFail($id);
        return view("products.show",compact("product"));

    }

    public function destroy(request $request,$id){
        $product = product::findOrFail($id);
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
    
}
