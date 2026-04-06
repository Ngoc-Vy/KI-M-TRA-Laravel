<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    // Tên bảng phải khớp với phpMyAdmin (t_food viết thường)
    protected $table = 't_food';

    // Các cột cho phép lưu dữ liệu
    protected $fillable = [
        'name', 
        'category', 
        'description', 
        'price', 
        'image'
    ];
    public $timestamps = false;
}