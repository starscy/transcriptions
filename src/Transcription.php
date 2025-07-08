<?php

namespace Starscy\MyFirstPackage;

class Transcription
{
    protected array $lines;
    public static function load(string $path): self
    {
        if (!file_exists($path)) {
            throw new \InvalidArgumentException("File not found: $path");
        }

        $instance = new static();

        //$instance->lines = file($path);
        $instance->lines = $instance->discardInvalidLines(file($path));

        return $instance;
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
        $lines = array_map('trim', $lines);
        return array_values(array_filter(
            $lines,
            fn ($line) => Line::valid($line)
        ));
    }
}
