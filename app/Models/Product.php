<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'product_status',
        'product_type',
        'added_by_user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'foreign_key', 'added_by_user_id');
    }
}

//Observer registered in Events serviceProvider
