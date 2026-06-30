<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evidence extends Model
{
    use HasFactory;

    protected $table = 'evidences';
    protected $primaryKey = 'id_evidence';
    public $incrementing = true;
    protected $keyType = 'integer';

    public $timestamps = false;

    protected $fillable = [
        'report_id',
        'file_path',
    ];

    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id', 'id_report');
    }
}