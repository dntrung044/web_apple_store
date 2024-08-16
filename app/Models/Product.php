<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductCategory;
use App\Models\ProductReview;
use App\Models\ProductImage;
use App\Models\ProductSize;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Product extends Model
{
    use HasFactory;
    protected $with = ['category'];
    protected $appends = ['thumbnail_url', 'more_images_url', 'link', 'price_with_currency'];

    protected $guarded = [];
    protected $fillable = [
        'name',
        'description',
        'short_description',
        'product_details',
        'thumbnail',
        'more_images',
        'price',
        'price_sale',
        'offer',
        'availability',
        'inventory',
        'total_rating_star',
        'total_rating_number',
        'category_id',
        'brand',
        'tag',
        'slug',
        'status',
    ];

    protected $casts = [
        'more_images' => 'array',
        'status' => 'string',
        'total_rating_star' => 'float',
        'total_rating_number' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query
            ->when(
                $filters['search'] ?? false,
                fn($query, $search) =>
                $query
                    ->where(
                        fn($query) =>
                        $query
                            ->where('name', 'like', "%{$search}%")
                            ->orWhere('description', 'like', "%{$search}%")
                            ->orWhere('short_description', 'like', "%{$search}%")
                            ->orWhere('id', '=', $search)
                    )
            )


            ->when(
                $filters['category'] ?? false,
                fn($query, $categories) =>
                $query
                    ->whereHas(
                        'category',
                        fn($query) =>
                        $query
                            ->whereIn('slug', json_decode($categories))
                    )
            )

            ->when(
                $filters['tag'] ?? false,
                fn($query, $tags) =>
                $query
                    ->whereIn('tag', json_decode($tags))

            )

            ->when(
                $filters['availability'] ?? false,
                fn($query, $availability) =>
                $query
                    ->whereIn('availability', json_decode($availability))

            )

            ->when(
                $filters['brand'] ?? false,
                fn($query, $brands) =>
                $query
                    ->whereIn('brand', json_decode($brands))

            )


            ->when(
                $filters['dateStart'] ?? false,
                function ($query, $dateStart) {
                    $dateStart = Carbon::createFromFormat('m/d/Y', $dateStart)->format('Y-m-d');
                    $query
                        ->whereDate('created_at', '>=', $dateStart);
                }
            )

            ->when(
                $filters['dateEnd'] ?? false,
                function ($query, $dateEnd) {
                    $dateEnd = Carbon::createFromFormat('m/d/Y', $dateEnd)->format('Y-m-d');
                    $query
                        ->whereDate('created_at', '<=', $dateEnd);
                }
            )

            ->when(
                $filters['sortBy'] ?? 'default',
                function ($query, $sortBy) {
                    if ($sortBy === 'date-dsc') {
                        $query->latest();
                    }
                    if ($sortBy === 'date-asc') {
                        $query->oldest();
                    }
                    if ($sortBy === 'price-dsc') {
                        $query->orderBy('price', 'desc');
                    }
                    if ($sortBy === 'price-asc') {
                        $query->orderBy('price', 'asc');
                    }
                    if ($sortBy === 'inventory-asc') {
                        $query->orderBy('inventory', 'asc');
                    }
                    if ($sortBy === 'inventory-dsc') {
                        $query->orderBy('inventory', 'dsc');
                    }
                    if ($sortBy === 'default') {
                        $query->latest();
                    }
                }
            )

            ->when(
                $filters['minPrice'] ?? false,
                fn($query, $minPrice) =>
                $query
                    ->where('price', '>=', $minPrice)
            )

            ->when(
                $filters['maxPrice'] ?? false,
                fn($query, $maxPrice) =>
                $query
                    ->where('price', '<=', $maxPrice)
            );
    }

    protected function thumbnailUrl(): Attribute
    {
        return Attribute::make(
            get: fn($value) => asset($this->thumbnail ?? ''),
        );
    }

    protected function moreImages(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                return json_encode($value);
            }
        );
    }

    // protected function moreImagesUrl(): Attribute
    // {
    //     return Attribute::make(
    //         get: function ($value) {
    //             $images = $this->more_images ?? [];

    //             return json_encode(array_map(fn($value): string => asset($value ?? ''), $images));
    //         }
    //     );
    // }

    protected function moreImagesUrl(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                // Nếu $this->more_images là một chuỗi, giải mã nó thành mảng
                $images = is_string($this->more_images) ? json_decode($this->more_images, true) : $this->more_images;

                // Kiểm tra nếu $images là một mảng
                if (is_array($images)) {
                    // Sử dụng array_map để chuyển đổi từng phần tử trong mảng
                    $mappedImages = array_map(fn($image): string => asset($image ?? ''), $images);

                    // Trả về chuỗi JSON chứa các URL đầy đủ
                    return json_encode($mappedImages);
                }

                // Trả về một mảng trống nếu $images không phải là một mảng
                return json_encode([]);
            }
        );
    }

    protected function priceWithCurrency(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                $currencySymbol = EcommerceSettings::first()->currency_symbol;
                return "{$currencySymbol} {$this->price}";
            }
        );
    }

    protected function link(): Attribute
    {
        return Attribute::make(
            get: fn($value) => asset("/products/" . $this->slug)
        );
    }
}
