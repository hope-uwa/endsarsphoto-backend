<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\SearchInterface;

class SearchController extends Controller
{

    protected $search;

    public function __construct(SearchInterface $searchInterface)
    {
        $this->search = $searchInterface;
    }
    
    public function index()
    {
        return $this->search->searchPosts();
    }
}
