<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'input_image_url', 'processed_image_url', 'cost',
        'replicate_id', 'replicate_status', 'replicate_input', 'replicate_output',
        'replicate_error', 'replicate_started_at', 'replicate_completed_at',
        'status', 'version',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
