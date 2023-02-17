<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'replicate_id', 'cost', 'input', 'output', 'image_url',
        'replicate_status', 'replicate_created_at', 'started_at', 'completed_at',
        'error', 'version', 'replicate_payload'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
