<?php

namespace Starscy\MyFirstPackage;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use JsonSerializable;
use Traversable;

class Collection implements Countable, IteratorAggregate, ArrayAccess, JsonSerializable
{

    public function __construct(protected array $items = [])
    {
        $this->items = $items;
    }

    public function map(callable $fn): self
    {
       return new static(
           array_map($fn, $this->items)
       );
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }
    public function offsetExists($key)
    {
        return isset($this->items[$key]);
    }

    public function offsetGet($key)
    {
        return $this->items[$key];
    }

    public function offsetSet(mixed $key, mixed $value)
    {
        if (is_null($key)) {
            $this->items[] = $value;
        } else {
            $this->items[$key] = $value;
        }
    }

    public function offsetUnset(mixed $key)
    {
        unset($this->items[$key]);
    }

    public function jsonSerialize()
    {
        return $this->items;
    }
}
