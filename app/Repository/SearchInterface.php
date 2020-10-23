<?php

namespace App\Repository;

use Illuminate\Http\Request;

interface SearchInterface
{

    /**
     * 
     * Searches and sorts Post 
     *
     * @return collection 
     */
    public function searchPosts();
}