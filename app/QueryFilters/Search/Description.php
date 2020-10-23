<?php

namespace App\QueryFilters\Search;

use App\QueryFilters\Filter;

class Description extends Filter
{
    /**
     * Query filter for state.
     *
     * @param Builder $builder
     * @return void
     */
    protected function applyFilter($builder)
    {
        return $builder->orWhere('posts.description', 'LIKE', '%'.request($this->filterName()).'%');
    }
}
