<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use CloudinaryLabs\CloudinaryLaravel\MediaAlly;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Picture extends Model
{
    use HasFactory;

    /**
     * Guarded columns
     *
     * @var array
     */
    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Relationship with Post
     *
     * @return Builder
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
