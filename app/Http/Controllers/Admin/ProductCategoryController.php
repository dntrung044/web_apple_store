<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\ProductCategory;
use App\Services\FileManagement;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductCategoryController extends Controller
{
    public function index()
    {
        return Inertia::render(
            'Admin/Products/Categories/Index',
            [
                'categories' => ProductCategory::filter(
                    request(['search'])
                )
                    ->paginate(10)->withQueryString(),
                'filters' => Request::only(['search']),
            ]
        );
    }

    public function create()
    {
        return Inertia::render('Admin/Products/Categories/Create', [
            'categories' => ProductCategory::whereNull('parent_id')->get()
        ]);
    }

    public function store(FileManagement $fileManagement)
    {
        $attributes = $this->validateCategory();
        $attributes['image'] =
            $fileManagement->uploadFile(
                file: $attributes['image'] ?? false,
                path: 'images/categories/' . $attributes['slug'] . '/img',
                storeAsName: 'thumbnail'
            );

        ProductCategory::create($attributes);

        return redirect('/dashboard/product_categories')->with('success', 'Category Created!');
    }

    public function edit($id)
    {
        $category = ProductCategory::find($id);
        return Inertia::render('Admin/Products/Categories/Edit', [
            'category' => $category,
            'parent_categories' => ProductCategory::whereNull('parent_id')->get()
        ]);
    }

    public function update($id, FileManagement $fileManagement)
    {
        $category = ProductCategory::find($id);
        $attributes = $this->validateCategory($category);
        if ($attributes['image'] ?? false) {
            $attributes['image'] =
                $fileManagement->uploadFile(
                    file: $attributes['image'] ?? false,
                    deleteOldFile: true,
                    oldFile: $category->image,
                    path: 'images/categories/' . ($category['slug'] !== $attributes['slug'] ? $attributes['slug'] : $category['slug']) . '/img',
                    storeAsName: 'thumbnail'

                );
        }
        if ($category->slug !== $attributes['slug']) {
            $fileManagement->moveFiles(
                oldPath: 'images/categories/' . $category['slug'] . '/img',
                newPath: 'images/categories/' . $attributes['slug'] . '/img',
                deleteDirectory: 'images/categories/' . $category['slug']
            );
            $attributes['image'] = str_replace($category['slug'], $attributes['slug'], $category['image']);
        }
        if ($attributes['parent_id'] == null) {
            $category->parent_id == null;
        }

        $category->update($attributes);

        return back()->with('success', 'Cập nhật danh mục thành công!');
    }


    public function destroy($id)
    {
        $category = ProductCategory::find($id);
        $category->delete();
        Storage::deleteDirectory('images/categories/' . $category['slug']);

        return Inertia::location('/dashboard/product_categories');
    }
    protected function validateCategory(?ProductCategory $category = null): array
    {
        $category ??= new ProductCategory();

        return request()->validate(
            [
                'name' => 'required',
                'slug' => 'required',
                'status' => 'required',
                'parent_id' => 'nullable|exists:product_categories,id',
                'image' => $category->exists ? 'nullable|mimes:jpeg,png|max:2048' : 'required|mimes:jpeg,png|max:2048',
            ],
            [
                'name.required' => 'Tên danh mục là bắt buộc.',
                'image.required' => 'Vui lòng tải lên hình ảnh dạng jpg/png có kích thước nhỏ hơn 2MB.',
                'image.mimes' => 'Hình ảnh phải là định dạng jpeg hoặc png.',
                'image.max' => 'Kích thước hình ảnh không được vượt quá 2MB.',
            ]
        );
    }
}
