<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\HomePageContent;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    public function index()
    {

        return Inertia::render('FrontEnd/HomePage', [

            'categories' => ProductCategory::all(),
            'productBestSellers' => Product::with("category")->paginate(4),


        ]);
    }
    public function product_list()
    {
        $products = Product::with('category', 'reviews', 'images', 'sizes')->orderBy('id', 'DESC')->get();
        return Inertia::render('FrontEnd/ProductList', [
            'products' => $products,
        ]);
    }
    public function product_detail($id)
    {
        $product = Product::with('category', 'reviews', 'images', 'sizes')->find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return Inertia::render('FrontEnd/ProductDetail', [
            'product' => $product,
            'id' => $id,
        ]);
    }
}
