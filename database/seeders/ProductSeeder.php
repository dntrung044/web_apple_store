<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert(
            [
                [
                    'name' => 'iPhone 14 Pro Max',
                    'description' => 'iPhone mới nhất với các tính năng tiên tiến và thiết kế sang trọng.',
                    'short_description' => 'Tính năng tiên tiến, thiết kế sang trọng.',
                    'product_details' => 'Màn hình 6.7 inch, chip A16 Bionic, hỗ trợ 5G, hệ thống camera Pro.',
                    'thumbnail' => 'https://example.com/images/iphone_14_pro_max.jpg',
                    'more_images' => json_encode([
                        'https://example.com/images/iphone_14_pro_max_1.jpg',
                        'https://example.com/images/iphone_14_pro_max_2.jpg',
                        'https://example.com/images/iphone_14_pro_max_3.jpg'
                    ]),
                    'price' => 26990000.00,
                    'price_sale' => 24990000.00,
                    'offer' => 'Ưu đãi có hạn: Giảm 2 triệu!',
                    'availability' => 'Còn hàng',
                    'inventory' => 50,
                    'total_rating_star' => 4.8,
                    'total_rating_number' => 1200,
                    'category_id' => 1,
                    'brand' => 'Apple',
                    'tag' => 'điện thoại,iphone',
                    'slug' => Str::slug('iPhone 14 Pro Max'),
                    'status' => 'active',
                ],
                [
                    'name' => 'MacBook Pro 16-inch',
                    'description' => 'MacBook Pro hiệu suất cao với chip M2 Max dành cho chuyên gia.',
                    'short_description' => 'Hiệu suất cao, chip M2 Max.',
                    'product_details' => 'Màn hình Retina 16-inch, chip M2 Max, SSD 1TB, RAM 32GB.',
                    'thumbnail' => 'https://example.com/images/macbook_pro_16.jpg',
                    'more_images' => json_encode([
                        'https://example.com/images/macbook_pro_16_1.jpg',
                        'https://example.com/images/macbook_pro_16_2.jpg',
                        'https://example.com/images/macbook_pro_16_3.jpg'
                    ]),
                    'price' => 59990000.00,
                    'price_sale' => 57990000.00,
                    'offer' => 'Tiết kiệm 2 triệu!',
                    'availability' => 'Còn hàng',
                    'inventory' => 30,
                    'total_rating_star' => 4.9,
                    'total_rating_number' => 900,
                    'category_id' => 2,
                    'brand' => 'Apple',
                    'tag' => 'máy tính xách tay,macbook',
                    'slug' => Str::slug('MacBook Pro 16-inch'),
                    'status' => 'active',
                ],
                [
                    'name' => 'iPad Pro 12.9-inch',
                    'description' => 'iPad Pro với màn hình Retina 12.9 inch, hỗ trợ bút Apple Pencil.',
                    'short_description' => 'Màn hình Retina lớn, hỗ trợ bút Pencil.',
                    'product_details' => 'Màn hình 12.9 inch, chip M2, hỗ trợ 5G, bút Apple Pencil.',
                    'thumbnail' => 'https://example.com/images/ipad_pro_12_9.jpg',
                    'more_images' => json_encode([
                        'https://example.com/images/ipad_pro_12_9_1.jpg',
                        'https://example.com/images/ipad_pro_12_9_2.jpg',
                        'https://example.com/images/ipad_pro_12_9_3.jpg'
                    ]),
                    'price' => 32990000.00,
                    'price_sale' => 30990000.00,
                    'offer' => 'Giảm ngay 2 triệu!',
                    'availability' => 'Còn hàng',
                    'inventory' => 40,
                    'total_rating_star' => 4.7,
                    'total_rating_number' => 800,
                    'category_id' => 3,
                    'brand' => 'Apple',
                    'tag' => 'máy tính bảng,ipad',
                    'slug' => Str::slug('iPad Pro 12.9-inch'),
                    'status' => 'active',
                ],
                [
                    'name' => 'Apple Watch Series 8',
                    'description' => 'Apple Watch Series 8 với tính năng theo dõi sức khỏe và thể thao.',
                    'short_description' => 'Theo dõi sức khỏe, thể thao.',
                    'product_details' => 'Màn hình Retina OLED, theo dõi sức khỏe, hỗ trợ ECG và theo dõi oxy trong máu.',
                    'thumbnail' => 'https://example.com/images/apple_watch_series_8.jpg',
                    'more_images' => json_encode([
                        'https://example.com/images/apple_watch_series_8_1.jpg',
                        'https://example.com/images/apple_watch_series_8_2.jpg',
                        'https://example.com/images/apple_watch_series_8_3.jpg'
                    ]),
                    'price' => 12990000.00,
                    'price_sale' => 11990000.00,
                    'offer' => 'Tiết kiệm 1 triệu!',
                    'availability' => 'Còn hàng',
                    'inventory' => 70,
                    'total_rating_star' => 4.9,
                    'total_rating_number' => 1500,
                    'category_id' => 1,
                    'brand' => 'Apple',
                    'tag' => 'đồng hồ thông minh,apple watch',
                    'slug' => Str::slug('Apple Watch Series 8'),
                    'status' => 'active',
                ],
                [
                    'name' => 'AirPods Pro',
                    'description' => 'Tai nghe không dây với khả năng chống ồn chủ động và âm thanh trong trẻo.',
                    'short_description' => 'Chống ồn chủ động, âm thanh chất lượng cao.',
                    'product_details' => 'Chống ồn chủ động, chế độ xuyên âm, hộp sạc không dây, âm thanh spatial audio.',
                    'thumbnail' => 'https://example.com/images/airpods_pro.jpg',
                    'more_images' => json_encode([
                        'https://example.com/images/airpods_pro_1.jpg',
                        'https://example.com/images/airpods_pro_2.jpg',
                        'https://example.com/images/airpods_pro_3.jpg'
                    ]),
                    'price' => 5499000.00,
                    'price_sale' => 5299000.00,
                    'offer' => 'Giảm 200k khi mua kèm iPhone.',
                    'availability' => 'Còn hàng',
                    'inventory' => 100,
                    'total_rating_star' => 4.8,
                    'total_rating_number' => 1800,
                    'category_id' => 1,
                    'brand' => 'Apple',
                    'tag' => 'tai nghe,airpods',
                    'slug' => Str::slug('AirPods Pro'),
                    'status' => 'active',
                ],
                [
                    'name' => 'Apple Pencil (Gen 2)',
                    'description' => 'Bút Apple Pencil thế hệ 2 với độ nhạy cao và kết nối không dây.',
                    'short_description' => 'Bút cảm ứng, kết nối không dây.',
                    'product_details' => 'Bút Apple Pencil thế hệ 2, kết nối không dây, sạc không dây, độ chính xác cao.',
                    'thumbnail' => 'https://example.com/images/apple_pencil_gen2.jpg',
                    'more_images' => json_encode([
                        'https://example.com/images/apple_pencil_gen2_1.jpg',
                        'https://example.com/images/apple_pencil_gen2_2.jpg',
                        'https://example.com/images/apple_pencil_gen2_3.jpg'
                    ]),
                    'price' => 2999000.00,
                    'price_sale' => 2899000.00,
                    'offer' => 'Giảm ngay 100k khi mua kèm iPad Pro.',
                    'availability' => 'Còn hàng',
                    'inventory' => 150,
                    'total_rating_star' => 4.9,
                    'total_rating_number' => 2200,
                    'category_id' => 3,
                    'brand' => 'Apple',
                    'tag' => 'phụ kiện,apple pencil',
                    'slug' => Str::slug('Apple Pencil (Gen 2)'),
                    'status' => 'active',
                ],
                [
                    'name' => 'MacBook Air M2',
                    'description' => 'MacBook Air với chip M2, mỏng nhẹ và hiệu suất cao.',
                    'short_description' => 'Mỏng nhẹ, hiệu suất cao với chip M2.',
                    'product_details' => 'Màn hình Retina 13.6 inch, chip M2, SSD 512GB, RAM 16GB.',
                    'thumbnail' => 'https://example.com/images/macbook_air_m2.jpg',
                    'more_images' => json_encode([
                        'https://example.com/images/macbook_air_m2_1.jpg',
                        'https://example.com/images/macbook_air_m2_2.jpg',
                        'https://example.com/images/macbook_air_m2_3.jpg'
                    ]),
                    'price' => 34990000.00,
                    'price_sale' => 32990000.00,
                    'offer' => 'Giảm 2 triệu trong tháng này!',
                    'availability' => 'Còn hàng',
                    'inventory' => 45,
                    'total_rating_star' => 4.7,
                    'total_rating_number' => 1000,
                    'category_id' => 2,
                    'brand' => 'Apple',
                    'tag' => 'máy tính xách tay,macbook air',
                    'slug' => Str::slug('MacBook Air M2'),
                    'status' => 'active',
                ],
                [
                    'name' => 'iMac 24-inch M1',
                    'description' => 'iMac với màn hình 24-inch, chip M1, và thiết kế mỏng nhẹ.',
                    'short_description' => 'Màn hình lớn, chip M1, thiết kế mỏng nhẹ.',
                    'product_details' => 'Màn hình Retina 24 inch, chip M1, SSD 256GB, RAM 8GB.',
                    'thumbnail' => 'https://example.com/images/imac_24_m1.jpg',
                    'more_images' => json_encode([
                        'https://example.com/images/imac_24_m1_1.jpg',
                        'https://example.com/images/imac_24_m1_2.jpg',
                        'https://example.com/images/imac_24_m1_3.jpg'
                    ]),
                    'price' => 39990000.00,
                    'price_sale' => 37990000.00,
                    'offer' => 'Ưu đãi tháng 8: Giảm 2 triệu!',
                    'availability' => 'Còn hàng',
                    'inventory' => 20,
                    'total_rating_star' => 4.9,
                    'total_rating_number' => 850,
                    'category_id' => 2,
                    'brand' => 'Apple',
                    'tag' => 'máy tính để bàn,imac',
                    'slug' => Str::slug('iMac 24-inch M1'),
                    'status' => 'active',
                ],
                [
                    'name' => 'Apple TV 4K',
                    'description' => 'Thiết bị Apple TV với hỗ trợ độ phân giải 4K và các ứng dụng giải trí.',
                    'short_description' => 'Hỗ trợ 4K, giải trí không giới hạn.',
                    'product_details' => 'Apple TV 4K, hỗ trợ HDR, điều khiển từ xa, tích hợp Siri.',
                    'thumbnail' => 'https://example.com/images/apple_tv_4k.jpg',
                    'more_images' => json_encode([
                        'https://example.com/images/apple_tv_4k_1.jpg',
                        'https://example.com/images/apple_tv_4k_2.jpg',
                        'https://example.com/images/apple_tv_4k_3.jpg'
                    ]),
                    'price' => 4999000.00,
                    'price_sale' => 4799000.00,
                    'offer' => 'Giảm 200k khi mua kèm iPhone hoặc MacBook.',
                    'availability' => 'Còn hàng',
                    'inventory' => 75,
                    'total_rating_star' => 4.6,
                    'total_rating_number' => 650,
                    'category_id' => 1,
                    'brand' => 'Apple',
                    'tag' => 'giải trí,apple tv',
                    'slug' => Str::slug('Apple TV 4K'),
                    'status' => 'active',
                ],
            ]
        );
    }
}
