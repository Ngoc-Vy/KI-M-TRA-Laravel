<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('cars', function (Blueprint $table) {
        $table->id();
        $table->string('model');
        $table->text('description'); // Đảm bảo có dòng này
        $table->date('produced_on');
        $table->string('image');
        $table->foreignId('mf_id')->constrained('mfs'); // Khóa ngoại tới bảng mfs
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
