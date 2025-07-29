<?php

namespace Starscy\MyFirstPackage;

class Lines extends Collection
{
    public function __construct(protected array $lines)
    {
        parent::__construct($lines);
    }

    public function html(): string
    {
        return $this->map(fn(Line $line) => $line->toHtml());
    }

    public function __toString(): string
    {
        return implode("\n", $this->lines);
    }
}
