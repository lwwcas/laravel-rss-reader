<?php

namespace Lwwcas\LaravelRssReader\Concerns;

trait HasBlacklist
{
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
}
