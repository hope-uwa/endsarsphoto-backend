<?php

namespace App\QueryFilters;

use Closure;
use Illuminate\Support\Str;

abstract class Filter
{
    public function handle($request, Closure $next)
    {
        if (! request()->has($this->filterName())) {
            return $next($request);
        }

        $builder = $next($request);

        return $this->applyFilter($builder);
    }

    /**
     * Class base conversion for filtering.
     *
     * @return string
     */
    protected function filterName()
    {
        return Str::snake(class_basename($this));
    }

    /**
     * Converts filtering comma seperated values to array.
     *
     * @param string $value
     * @return array
     */
    public function checkFilterValue($value)
    {
        return count(explode(',', $value)) <= 1 ? [$value] : explode(',', $value);
    }

    abstract protected function applyFilter($builder);
}
