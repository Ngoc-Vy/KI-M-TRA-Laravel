<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('T_food', function (Blueprint $table) {
        $table->id();
        $table->string('name', 255); // Giới hạn độ dài để tối ưu database
        $table->string('category'); 
        $table->text('description')->nullable();
        $table->decimal('price', 15, 2); // Chuẩn hơn cho tiền tệ
        $table->string('image')->nullable();
        $table->string('promotion')->nullable(); // Thêm nếu đề có nhắc tới khuyến mãi
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_food');
    }
};
