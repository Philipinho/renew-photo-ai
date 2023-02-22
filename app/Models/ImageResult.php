<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'cost',
        'replicate_id',
        'url',
        'input_image_url',
        'output_image_url',
        'error',
        'version',
        'started_at',
        'completed_at',
        'predict_time',
        'status',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
