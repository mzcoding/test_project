<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\ProductsCollection;
use App\Models\Product;
use Illuminate\Http\Request;

final class ProductController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): ProductsCollection
    {
        $products = Product::all();
        if ($products->isEmpty()) {
            Product::factory(10)->create();
        }

        return new ProductsCollection($products);
    }
}
