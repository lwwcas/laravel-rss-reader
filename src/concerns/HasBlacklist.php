<?php

namespace Lwwcas\LaravelRssReader\Concerns;

trait HasBlacklist
{
    public function isOnBlacklist(): bool
    {
        $blacklist = $this->black_list;
        if ($blacklist === null) {
            return false;
        }

        return (bool) $blacklist;
    }

    public function addOnBlacklist()
    {
        return $this->update(['black_list' => true]);
    }

    public function removeOfBlacklist()
    {
        return \Illuminate\Support\Facades\DB::transaction(function () {
            $this->update(['black_list' => false]);
            $this->update(['bad_words' => []]);
        });
    }

    public function badWords()
    {
        $badWords = $this->bad_words;
        if ($badWords === null) {
            return [];
        }

        return $badWords;
    }

    /**
     * Find a article by badWord.
     *
     * @param string $badWord
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function scopeWhereBadWord($query, string $badWord)
    {
        return $query->whereJsonContains('bad_words', $badWord);
    }

    public function hasBadWords(): bool
    {
        $badWords = $this->bad_words;
        if ($badWords === null) {
            return false;
        }

        if (is_array($badWords) === false) {
            return false;
        }

        return (bool) count($badWords) > 0 ? true : false;
    }

    public function addBadWords(array $badWords)
    {
        return $this->update(['bad_words' => $badWords]);
    }

    public function addNewBadWords(array $badWords)
    {
        $oldBadWords = $this->select('bad_words')->limit(1)->first();
        if ($oldBadWords === null) {
            return $this->addBadWords($badWords);
        }

        $oldBadWords = $oldBadWords->bad_words;
        $newBadWordsList = array_merge($oldBadWords, $badWords);
        return $this->addBadWords($newBadWordsList);
    }

    public function clearBadWords()
    {
        $this->update(['bad_words' => []]);
    }
}
