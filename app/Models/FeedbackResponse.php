<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackResponse extends Model
{
    use HasFactory;

    protected $table = 'feedback_responses';
    protected $primaryKey = 'id_response';
    public $incrementing = true;
    protected $keyType = 'integer';

    protected $fillable = [
        'report_id',
        'admin_id',
        'response_text',
    ];

    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id', 'id_report');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id', 'id_user');
    }
}