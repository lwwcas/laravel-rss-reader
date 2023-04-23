<?php

namespace Lwwcas\LaravelRssReader\Abstract;

class FileGetContentsWrapper
{
    private $fileUrl = 'http://www.localhost.com';
    private $errorMessage = 'Page not found';

    public function setUrl(string $url)
    {
        $this->fileUrl = $url;
        return $this;
    }

    public function getUrl(): string
    {
        return $this->fileUrl;
    }

    public function setErrorMessage(string $message)
    {
        $this->errorMessage = $message;
        return $this;
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    public function getContents()
    {
        $url = $this->getUrl();
        $message = $this->getErrorMessage();
        $contents = @file_get_contents($url);

        if ($contents === false) {
            throw new \LogicException($message);
        }

        return $contents;
    }
}
