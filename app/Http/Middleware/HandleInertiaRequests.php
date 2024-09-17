<?php

namespace App\Http\Middleware;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        // Lấy tất cả danh mục cha cùng với danh mục con
        $categories = ProductCategory::whereNull('parent_id')
            ->with('children')
            ->get();

        return array_merge(parent::share($request), [
            'product_categories' => $categories,
        ]);
    }
}
