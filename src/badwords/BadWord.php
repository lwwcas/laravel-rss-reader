<?php

namespace Lwwcas\LaravelRssReader\BadWords;

class BadWord
{
    use BadWordEn;

    public static function verify(string $word): array
    {
        $badwords = self::words();

        $badWord = array_search($word, $badwords);
        $isBadWord = $badWord === false ? false : true;

        if ($isBadWord === false) {
            return [
                'black-list' => $isBadWord,
                'word' => null,
            ];
        }

        return [
            'black-list' => $isBadWord,
            'words' => $badwords[$badWord],
        ];
    }

    public static function verifyParagraph(string $paragraph): array
    {
        $badWords = [];
        $backList = false;
        $paragraph = self::clean($paragraph);
        $words = explode(' ', $paragraph);

        foreach ($words as $word) {
            $verification = self::verify($word);
            if ($verification['black-list'] === true) {
                $backList = true;
                $badWords[] = $verification['word'];
            }
        }

        return [
            'black-list' => $backList,
            'words' => $badWords,
        ];
    }

    private static function clean(string $text): string
    {
        $text = strip_tags($text);
        $text = str_replace('.', '', $text);
        $text = str_replace(',', '', $text);
        $text = str_replace('!', '', $text);
        $text = str_replace('?', '', $text);
        $text = preg_replace("/<br>|\n/", '', $text);

        return $text;
    }

    private static function words()
    {
        return self::enWords();
    }
}
