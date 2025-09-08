<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = request()->get('page', 1);
        $perPage = 2000;

        $data = Cache::tags('products')->remember("product_list_{$page}", 300, function () use ($perPage) {
            return Product::paginate($perPage);
        });
        // $data = Cache::remember("product_list", 300, function () {
        //     return Product::all();
        // });
        // dd($data);

        // foreach ($data as $key => $value) {
        //     echo $value->name . " id " . $value->id . "<br/>";
        // }

        // return response()->json($data);
        return view('index', compact('data'));
    }

    public function store(ProductRequest $request)
    {
        try {
            $product = $request->validated();

            $product = Product::create($request->all());

            // Cache::forget('product_list');

            return response()->json($product, 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Gagal menambahkan produk', 'error' => $th->getMessage()], 400);
        }
    }

    public function show($id)
    {
        return response()->json(Product::findOrFail($id));
    }

    public function update(ProductRequest $request, $id)
    {

        $product = $request->validated();
        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        // Cache::forget('product_list');

        return response()->json(['message' => 'success']);
    }

    public function destroy($id)
    {
        Product::destroy($id);
        // Cache::forget('product_list');
        return response()->json(null, 204);
    }
}
