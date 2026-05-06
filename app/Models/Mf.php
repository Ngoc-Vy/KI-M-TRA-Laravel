<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // ✅ Thêm dòng này

class Mf extends Model
{
    use HasFactory;

    protected $table = 'mfs'; // Đảm bảo tên bảng khớp với DB

    /**
     * Một hãng sản xuất có NHIỀU xe
     */
    public function cars(): HasMany
    {
        // 'mf_id' là khóa ngoại nằm ở bảng cars
        // 'id' là khóa chính của bảng mfs
        return $this->hasMany(Car::class, 'mf_id', 'id');
    }
}