<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Services\FileManagement;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        return Inertia::render(
            'AdminDashboard/Products/Index',
            [
                'products' => Product::filter(
                    request(['search', 'category', 'tag', 'availability', 'brand', 'dateStart', 'dateEnd', 'sortBy'])
                )
                    ->paginate(10)->withQueryString(),
                'filters' => Request::only(['search', 'sortBy', 'categories', 'tags', 'availability', 'brands', 'dateStart', 'dateEnd'])
            ]
        );
    }

    public function show(Product $product)
    {
        return Inertia::render('AdminDashboard/Products/Show', [
            'product' => $product
        ]);
    }

    public function create()
    {
        return Inertia::render('AdminDashboard/Products/Create', [
            'categories' => ProductCategory::all()
        ]);
    }

    public function store(FileManagement $fileManagement)
    {
        $attributes = $this->validateProduct();

        if ($attributes['thumbnail'] ?? false) {
            $attributes['thumbnail'] =
                $fileManagement->uploadFile(
                    file: $attributes['thumbnail'],
                    path: 'images/products/' . $attributes['slug'] . '/thumbnail'
                );
        }

        if ($attributes['more_images'] ?? false) {
            $attributes['more_images'] =
                $fileManagement->uploadFile(
                    files: $attributes['more_images'],
                    path: 'images/products/' . $attributes['slug'] . '/more_images'
                );
        }

        Product::create($attributes);

        return redirect('/admin-dashboard/products')->with('success', 'Sản phẩm đã được tạo!');
    }


    // public function store(FileManagement $fileManagement)
    // {
    //     $attributes = $this->validateProduct();

    //     if ($attributes['thumbnail'] ?? false) {
    //         $attributes['thumbnail'] =
    //             $fileManagement->uploadFile(
    //                 file: $attributes['thumbnail'] ?? false,
    //                 path: 'images/products/' . $attributes['slug'] . '/thumbnail'
    //             );
    //     }

    //     if ($attributes['more_images'] ?? false) {
    //         $attributes['more_images'] =
    //             $fileManagement->uploadFile(
    //                 files: $attributes['more_images'] ?? false,
    //                 path: 'images/products/' . $attributes['slug'] . '/more_images'
    //             );
    //     }

    //     Product::create($attributes);

    //     return redirect('/admin-dashboard/products')->with('success', 'Product Created!');
    // }

    public function edit(Product $product)
    {
        return Inertia::render('AdminDashboard/Products/Edit', [
            'product' => $product,
            'categories' => ProductCategory::all()
        ]);
    }

    public function update(Product $product, FileManagement $fileManagement)
    {
        $attributes = $this->validateProduct($product);

        if ($attributes['thumbnail'] ?? false) {
            $attributes['thumbnail'] =
                $fileManagement->uploadFile(
                    file: $attributes['thumbnail'] ?? false,
                    path: 'images/products/' . $product->slug . '/thumbnail',
                    deleteOldFile: true,
                    oldFile: $product['thumbnail']
                );
        }

        if ($attributes['more_images'] ?? false) {
            $attributes['more_images'] =
                $fileManagement->uploadFile(
                    files: $attributes['more_images'] ?? false,
                    appendFilesTo: $product->more_images,
                    path: 'images/products/' . $product->slug . '/more_images'
                );
        }

        $product->update($attributes);

        return back()->with('success', 'Sản phẩm đã được cập nhật!');
    }

    public function deleteImage(Product $product, FileManagement $fileManagement)
    {

        $product->more_images =
            $fileManagement->deleteFile(
                fileUrl: request()->input('imageUrl'),
                oldFilesArray: $product->more_images
            );

        $product->save();

        return back()->with('success', 'Đã xoá hình ảnh sản phẩm!');
    }


    public function destroy(Product $product)
    {
        $product->delete();
        Storage::deleteDirectory('images/products/' . $product->slug);

        return redirect('/admin-dashboard/products')->with('success', 'Đã xoá hình ảnh sản phẩm!');
    }

    protected function validateProduct(?Product $product = null): array
    {
        $product ??= new Product();

        return request()->validate([
            'name' => 'required',
            'category_id' => ['required', Rule::exists('product_categories', 'id')],
            'brand' => 'nullable',
            'tag' => 'nullable',
            'inventory' => 'nullable',
            'availability' => 'required',
            'offer' => 'nullable',
            'price_sale' => 'nullable',
            'price' => 'required',
            'slug' => [$product->exists ? 'exclude' : 'required', Rule::unique('products', 'slug')->ignore($product)],
            'thumbnail' => $product->exists ? 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048' : 'required|mimes:jpeg,png,jpg,gif |max:5048',
            'more_images.*' => $product->exists ? 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048' : 'required|mimes:jpeg,png,jpg,gif |max:5048',
            'description' => 'required',
            'short_description' => 'required',
            'product_details' => 'nullable',
            'created_at' => 'nullable',
            'updated_at' => 'nullable',
        ], [
            'thumbnail' => 'Tải lên hình thu nhỏ dưới dạng jpg/png với kích thước nhỏ hơn 2MB',
            'more_images.*' => 'Tải lên hình dưới dạng jpg/png với kích thước nhỏ hơn 2MB',
        ]);
    }
}
