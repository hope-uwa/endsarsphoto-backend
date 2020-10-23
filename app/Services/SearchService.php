<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\DB;
use App\Repository\SearchInterface;


class SearchService implements SearchInterface
{
    public function searchPosts()
    {
        $posts = app(Pipeline::class)
            ->send(Post::query()
                    ->join('states', 'posts.state_id', '=', 'states.id')
                    ->select('posts.*', 'states.*'))
            ->through([
                \App\QueryFilters\Search\State::class,
                \App\QueryFilters\Search\Note::class,
                \App\QueryFilters\Search\Description::class,
                \App\QueryFilters\Sort\MostRecent::class,
            ])
            ->thenReturn()
            ->paginate(10)
            ->appends(request()->input());

        return formatResponse(200, 'Retrieved Posts', true, $posts);
    }
}