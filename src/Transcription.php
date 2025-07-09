<?php

namespace Starscy\MyFirstPackage;

class Transcription
{
    protected array $lines;

    public function __construct(array $lines)
    {
        $this->lines = $this->discardInvalidLines(array_map('trim', $lines));
    }

    public static function load(string $path): self
    {
        return new static(file($path));
    }

    public function lines(): array
    {
        $results = [];

        for ($i=0; $i<count($this->lines); $i+=2) {
            $results[] = new Line($this->lines[$i], $this->lines[$i + 1]);
        }

        return $results;
    }

    public function __toString(): string
    {
        return implode("\n", $this->lines);
    }

    public function discardInvalidLines(array $lines): array
    {
        return array_values(array_filter(
            $lines,
            fn ($line) => Line::valid($line)
        ));
    }

    public function htmlLines(): string
    {
        $htmlLines = array_map(
            fn (Line $line) => $line->toHtml(),
            $this->lines()
        );

        return implode("\n", $htmlLines);
    }
}
