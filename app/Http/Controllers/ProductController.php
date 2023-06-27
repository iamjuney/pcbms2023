<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ProductCreateRequest;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function index(): Response
    {
        $products = Product::select(['prod_id', 'prod_name', 'shelf_life', 'unit', 'appreciation', 'max_lvl', 'created_at', 'updated_at'])->get();

        return Inertia::render('Products', [
            'products' => $products
        ]);
    }

    public function store(ProductCreateRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $product = Product::create([
            'prod_name' => $validated['prod_name'],
            'shelf_life' => $validated['shelf_life'],
            'unit' => $validated['unit'],
            'appreciation' => $validated['appreciation'],
            'max_lvl' => $validated['max_lvl']
        ]);

        if ($product) {
            // Product creation was successful
            return to_route('products');
        } else {
            // Product creation failed
            throw ValidationException::withMessages([
                'message' => 'Product creation failed'
            ]);
        }
    }

    public function update(ProductCreateRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $product = Product::find($request->route('prod_id'));

        $product->prod_name = $validated['prod_name'];
        $product->shelf_life = $validated['shelf_life'];
        $product->unit = $validated['unit'];
        $product->appreciation = $validated['appreciation'];
        $product->max_lvl = $validated['max_lvl'];

        $product->save();

        return to_route('products');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $product = Product::find($request->route('prod_id'));

        $product->delete();

        return to_route('products');
    }
}
