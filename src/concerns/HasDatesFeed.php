<?php

namespace Lwwcas\LaravelRssReader\Concerns;

use Carbon\Carbon;

trait HasDatesFeed
{
    public function yesterday()
    {
        $yesterday = Carbon::yesterday()
            ->format($this->defaultArticlesDateFormat);

        $endDay = $this->endOfDay();

        $this->feedQuery = $this->betweenDate($yesterday, $endDay);
        return $this;
    }

    public function lastWeek()
    {
        $lastWeek = $this->lastDays(7);
        $endWeek = $this->endOfDay();

        $this->feedQuery = $this->betweenDate($lastWeek, $endWeek);
        return $this;
    }

    public function lastThreeDays()
    {
        $startDate = $this->lastDays(3);
        $endDate = $this->endOfDay();

        $this->feedQuery = $this->betweenDate($startDate, $endDate);
        return $this;
    }

    public function lastFiveDays()
    {
        $startDate = $this->lastDays(5);
        $endDate = $this->endOfDay();

        $this->feedQuery = $this->betweenDate($startDate, $endDate);
        return $this;
    }

    public function lastTenDays()
    {
        $startDate = $this->lastDays(10);
        $endDate = $this->endOfDay();

        $this->feedQuery = $this->betweenDate($startDate, $endDate);
        return $this;
    }

    public function lastFifteenDays()
    {
        $startDate = $this->lastDays(15);
        $endDate = $this->endOfDay();

        $this->feedQuery = $this->betweenDate($startDate, $endDate);
        return $this;
    }

    public function ofMonth(int $month, int $year = null)
    {
        if ($year === null) {
            $year = Carbon::now()->format('Y');
        }

        $dateSelected = Carbon::parse($year . '/' . $month . '/01');

        $startMonth = $dateSelected->format($this->defaultArticlesDateFormat);

        $endMonth = $dateSelected
            ->endOfMonth()
            ->format($this->defaultArticlesDateFormat);

        $this->feedQuery = $this->betweenDate($startMonth, $endMonth);
        return $this;
    }

    public function currentMonth()
    {
        $startMonth = Carbon::now()
            ->startOfMonth()
            ->format($this->defaultArticlesDateFormat);

        $endMonth = Carbon::now()
            ->endOfMonth()
            ->format($this->defaultArticlesDateFormat);

        $this->feedQuery = $this->betweenDate($startMonth, $endMonth);
        return $this;
    }

    public function lastMonth()
    {
        $startMonth = Carbon::now()
            ->startOfMonth()
            ->subMonth()
            ->format($this->defaultArticlesDateFormat);

        $endMonth = Carbon::now()
            ->subMonth()
            ->endOfMonth()
            ->format($this->defaultArticlesDateFormat);

        $this->feedQuery = $this->betweenDate($startMonth, $endMonth);
        return $this;
    }

    public function ofYear(int $year = null)
    {
        if ($year === null) {
            $year = Carbon::now()->format('Y');
        }

        $startYear = Carbon::parse($year . '/01/01')
            ->format($this->defaultArticlesDateFormat);

        $endYear = Carbon::parse($year . '/12/31')
            ->endOfMonth()
            ->format($this->defaultArticlesDateFormat);

        $this->feedQuery = $this->betweenDate($startYear, $endYear);
        return $this;
    }

    public function betweenDate(string $start, string $end)
    {
        $this->feedQuery = $this->whereBetween('date', [$start, $end]);
        return $this;
    }

    public function lastDays(int $days)
    {
        return Carbon::now()
            ->startOfDay()
            ->subDays($days)
            ->format($this->defaultArticlesDateFormat);
    }

    public function endOfDay()
    {
        return Carbon::now()
            ->endOfDay()
            ->format($this->defaultArticlesDateFormat);
    }
}
