<?php

namespace Lwwcas\LaravelRssReader\Concerns;

trait HasCustomFilter
{
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
