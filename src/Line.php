<?php

namespace Starscy\MyFirstPackage;

class Line
{
    public function __construct(public string $timestamp, public string $body)
    {

    }

    public static function valid($line)
    {
        return $line !== 'WEBVTT' && $line !== '' && !is_numeric($line);
    }

    public function beginningTimestamp(): string
    {
        preg_match('/^\d{2}:(\d{2}:\d{2})\.\d{3}/', $this->timestamp, $matches);

        return $matches[1];
    }

    public function toHtml(): string
    {
        return '<a href="?time=' . $this->beginningTimestamp() . '">' . $this->body . '</a>';
    }
}
