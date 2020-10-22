<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    /**
     * Fillable columns
     *
     * @var array
     */
    protected $fillable = [ 'code', 'state' ];

    /**
     * Hidden columns
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];
}
