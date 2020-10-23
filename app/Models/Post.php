<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * Guarded Columns
     *
     * @var array
     */
    protected $guarded = [];

    protected $with = ['state', 'picture'];

    /**
     * Relationship with Picture
     *
     * @return Builder
     */
    public function picture()
    {
        return $this->hasMany(Picture::class);
    }

    /**
     * Relationship with State
     *
     * @return Builder
     */
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    /**
     * Relationship with User
     *
     * @return Builder
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * scopes for pictures
     *
     * @return Builder
     */
    public function scopePicture()
    {
        return $this->picture();
    }
}
