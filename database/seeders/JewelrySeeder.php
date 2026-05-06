<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class JewelrySeeder extends Seeder
{
    public function run(): void
    {
        // Xóa dữ liệu an toàn, vô hiệu hóa khóa ngoại
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        if (Schema::hasTable('bill_detail')) DB::table('bill_detail')->truncate();
        if (Schema::hasTable('bills')) DB::table('bills')->truncate();
        if (Schema::hasTable('products')) DB::table('products')->truncate();
        if (Schema::hasTable('type_products')) DB::table('type_products')->truncate();
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 2. Tạo Type_products
        $categories = [
            ['id' => 1, 'name' => 'Nhẫn Đính Hôn', 'description' => 'Bộ sưu tập nhẫn đính hôn sang trọng.', 'image' => 'imagenhan.png', 'created_at' => Carbon::now()],
            ['id' => 2, 'name' => 'Dây Chuyền', 'description' => 'Dây chuyền vàng và bạc cao cấp.', 'image' => 'imgdaychuyen.png', 'created_at' => Carbon::now()],
            ['id' => 3, 'name' => 'Bông Tai', 'description' => 'Bông tai kim cương và ngọc trai.', 'image' => 'imagetai.png', 'created_at' => Carbon::now()],
            ['id' => 4, 'name' => 'Lắc Tay', 'description' => 'Vòng tay tinh xảo.', 'image' => 'imagelac.png', 'created_at' => Carbon::now()],
        ];
        DB::table('type_products')->insert($categories);

        // 3. Tạo Products
        $products = [];
        $categoryPrefixes = [
            1 => ['prefix' => 'imagenhan', 'name' => 'Nhẫn Cao Cấp', 'unit' => 'chiếc', 'price' => 15000000],
            2 => ['prefix' => 'imgdaychuyen', 'name' => 'Dây Chuyền Sang Trọng', 'unit' => 'sợi', 'price' => 20000000],
            3 => ['prefix' => 'imagetai', 'name' => 'Bông Tai Quý Phái', 'unit' => 'đôi', 'price' => 12000000],
            4 => ['prefix' => 'imagelac', 'name' => 'Lắc Tay Tinh Tế', 'unit' => 'chiếc', 'price' => 18000000],
        ];

        foreach ($categoryPrefixes as $id_type => $data) {
            $images = [
                $data['prefix'] . '.png',
                $data['prefix'] . '1.png',
                $data['prefix'] . '2.png',
                $data['prefix'] . '3.png',
                $data['prefix'] . '4.png',
                $data['prefix'] . '5.png',
            ];

            foreach ($images as $index => $imageName) {
                // Tạo giá ngẫu nhiên xíu cho đa dạng
                $unit_price = $data['price'] + ($index * 1500000);
                // Sản phẩm 1, 3, 5 được khuyến mãi
                $promotion_price = ($index % 2 != 0) ? $unit_price - 2000000 : 0;

                $products[] = [
                    'name' => $data['name'] . ' Mẫu ' . ($index + 1),
                    'id_type' => $id_type,
                    'description' => 'Tuyệt tác trang sức được chế tác tỉ mỉ.',
                    'unit_price' => $unit_price,
                    'promotion_price' => $promotion_price,
                    'image' => $imageName,
                    'unit' => $data['unit'],
                    'new' => ($index < 3) ? 1 : 0,
                    'top' => ($index == 1 || $index == 4) ? 1 : 0,
                    'created_at' => Carbon::now()
                ];
            }
        }

        DB::table('products')->insert($products);
    }
}
