<?php

namespace App\QueryFilters\Search;

use App\QueryFilters\Filter;

class Note extends Filter
{
    /**
     * Query filter for state.
     *
     * @param Builder $builder
     * @return void
     */
    protected function applyFilter($builder)
    {
        return $builder->orWhere('posts.note', 'LIKE', '%'.request($this->filterName()).'%');
    }
}
