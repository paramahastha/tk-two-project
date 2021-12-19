<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Output\ConsoleOutput;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        return view('product.list', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imagePath = $request->file('image')->store('public/product-image');

        $productStatus = Product::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'purchase_price' => $request->purchase_price,
            'sell_price' => $request->sell_price,
            'image' => $imagePath,
        ]);

        if ($productStatus) {
            $request->session()->flash('success', 'Product successfully added');
        } else {
            $request->session()->flash('error', 'Oops something went wrong, Product not saved');
        }
        return redirect('product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect('product')->with('error', 'Product not found');
        }
        return view('product.view', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        if ($product) {
            return view('product.edit', ['product' => $product]);
        } else {
            return redirect('product')->with('error', 'Product not found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect('product')->with('error', 'Product not found.');
        }

        $imageName = last(explode('/', Storage::url($product->image)));

        if (isset($imageName) && $request->hasFile('image')) {
            Storage::disk('product')->delete($imageName);
            $imagePath = $request->file('image')->store('public/product-image');
        } else {
            $imagePath = $product->image;
        }

        $productStatus = $product->update([
            'name' => $request->name,
            'desc' => $request->desc,
            'purchase_price' => $request->purchase_price,
            'sell_price' => $request->sell_price,
            'image' => $imagePath,
        ]);

        if ($productStatus) {
            return redirect('product')->with('success', 'Product successfully updated.');
        } else {
            return redirect('product')->with('error', 'Oops something went wrong. Product not updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where(['id' => $id])->first();
        $respStatus = $respMsg = '';
        if (!$product) {
            $respStatus = 'error';
            $respMsg = 'Product not found';
        }
        $productDelStatus = $product->delete();
        if ($productDelStatus) {
            $respStatus = 'success';
            $respMsg = 'Product deleted successfully';
        } else {
            $respStatus = 'error';
            $respMsg = 'Oops something went wrong. Product not deleted successfully';
        }
        return redirect('product')->with($respStatus, $respMsg);
    }
}
