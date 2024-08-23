<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductCategory::insert([
            [
                'name' => 'Điện thoại',
                'slug' => Str::slug('Điện thoại'),
                'image' => 'https://tanvienthanh.com/wp-content/uploads/2020/12/ip12_promax_fb9d9d2cf3c64dcab8d047b49ba5635c_1024x1024.jpg',
                'status' => 'active',
            ],
            [
                'name' => 'Máy tính xách tay',
                'slug' => Str::slug('Máy tính xách tay'),
                'image' => 'https://static-images.vnncdn.net/files/publish/2023/6/6/gsmarena-002-36.jpg',
                'status' => 'active',
            ],
            [
                'name' => 'Máy tính bảng',
                'slug' => Str::slug('Máy tính bảng'),
                'image' => '',
                'status' => 'active',
            ],
            [
                'name' => 'Đồng hồ thông minh',
                'slug' => Str::slug('Đồng hồ thông minh'),
                'image' => 'https://example.com/images/dong_ho_thong_minh.jpg',
                'status' => 'active',
            ],
            [
                'name' => 'Phụ kiện',
                'slug' => Str::slug('Phụ kiện'),
                'image' => 'https://example.com/images/phu_kien.jpg',
                'status' => 'active',
            ],
        ]);
    }
}
