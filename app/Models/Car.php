<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // ✅ Thêm dòng này để import

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'model',
        'produced_on',
        'image',
        'mf_id'
    ];

    /**
     * Thiết lập mối quan hệ: Một chiếc xe thuộc về một hãng sản xuất
     */
    public function mf(): BelongsTo
    {
        // 'mf_id' là khóa ngoại trong bảng cars
        // 'id' là khóa chính trong bảng mfs
        return $this->belongsTo(Mf::class, 'mf_id', 'id');
    }
}