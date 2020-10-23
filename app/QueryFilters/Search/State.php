<?php

namespace App\QueryFilters\Search;

use App\QueryFilters\Filter;

class State extends Filter
{
    /**
     * Query filter for state.
     *
     * @param Builder $builder
     * @return void
     */
    protected function applyFilter($builder)
    {
        return $builder->whereIn('posts.state_id', $this->checkFilterValue(request($this->filterName())));
    }
}
