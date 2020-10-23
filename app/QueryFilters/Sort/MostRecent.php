<?php

namespace App\QueryFilters\Sort;

use App\QueryFilters\Filter;

class MostRecent extends Filter
{
    /**
     * Apply filters to sort by asc or desc.
     *
     * @param  Builder $builder
     * @return void
     */
    protected function applyFilter($builder)
    {
        return $builder->orderBy('posts.created_at', request($this->filterName()));
    }
}
