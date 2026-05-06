<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FoodSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        // Danh sách danh mục đúng như đề bài yêu cầu ở câu 6
        $categories = ['Hoa quả', 'thực phẩm hữu cơ', 'thực phẩm khô', 'sản phẩm nổi bật'];

        for ($i = 0; $i < 10; $i++) {
            DB::table('T_food')->insert([
                'name' => $faker->word, // Tạo tên ngẫu nhiên
                'category' => $categories[array_rand($categories)], // Lấy ngẫu nhiên 1 trong 4 loại trên
                'description' => $faker->sentence(10),
                'price' => $faker->numberBetween(10000, 500000), // Giá từ 10k đến 500k
                'image' => 'food_' . ($i + 1) . '.jpg', // Giả lập tên file ảnh
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}