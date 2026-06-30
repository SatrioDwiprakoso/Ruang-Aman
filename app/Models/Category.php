<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'id_category';
    public $incrementing = true;
    protected $keyType = 'integer';

    protected $fillable = [
        'category_name',
        'weight_level',
    ];

    public function reports()
    {
        return $this->hasMany(Report::class, 'category_id', 'id_category');
    }
}