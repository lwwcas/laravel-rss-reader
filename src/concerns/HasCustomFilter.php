<?php

namespace Lwwcas\LaravelRssReader\Concerns;

trait HasCustomFilter
{
    public function customFilter()
    {
        return $this->custom;
    }

    /**
     * Find a article by custom filter.
     *
     * @param string $filter
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function scopeWhereCustomFilter($query, string $filter)
    {
        return $query->whereJsonContains('custom', $filter);
    }

    public function addCustomFilter(array $customFilter)
    {
        return $this->update(['custom' => $customFilter]);
    }

    public function addNewCustomFilter(array $customFilter)
    {
        $oldCustomFilter = $this->select('custom')->limit(1)->first();
        if ($oldCustomFilter === null) {
            return $this->addCustomFilter($customFilter);
        }

        $oldCustomFilter = $oldCustomFilter->custom;
        $newBadWordsList = array_merge($oldCustomFilter, $customFilter);
        return $this->addCustomFilter($newBadWordsList);
    }

    public function clearCustomFilter()
    {
        $this->update(['custom' => []]);
    }
}
