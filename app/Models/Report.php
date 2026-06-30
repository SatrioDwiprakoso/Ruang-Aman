<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';
    protected $primaryKey = 'id_report';
    public $incrementing = true;
    protected $keyType = 'integer';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'address',
        'chronology',
        'is_anonymous',
        'tracking_token',
        'status',
        'created_at',
    ];

    protected $casts = [
        'is_anonymous' => 'boolean',
        'created_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id_category');
    }

    public function evidences()
    {
        return $this->hasMany(Evidence::class, 'report_id', 'id_report');
    }

    public function feedbackResponses()
    {
        return $this->hasMany(FeedbackResponse::class, 'report_id', 'id_report')->orderBy('created_at', 'asc');
    }
}