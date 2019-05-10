<?php

namespace TDD\RecentlyUsedListKata;

class RecentlyUsedList
{
    public const UNLIMITED_LENGTH = -1;

    public const DEFAULT_LENGTH = 5;

    /** @var array */
    private $uniqueList = [];

    /** @var int */
    private $length;

    public function __construct(int $length = null)
    {
        $this->length = $length ?? self::DEFAULT_LENGTH;
    }

    public function enqueue(string $item): void
    {
        $this->removeItemIfPresent($item);
        $this->removeOldestIfLengthLimitIsReached();

        $this->uniqueList[] = $item;
    }

    public function dequeue(): ?string
    {
        return array_pop($this->uniqueList);
    }

    /**
     * @throws \OutOfBoundsException
     */
    public function get(int $index): ?string
    {
        if ($index < 0 || $index >= $this->length) {
            throw new \OutOfBoundsException("Index must be within range 0 - {$this->length}.");
        }

        $i = count($this->uniqueList) - $index - 1;

        return $this->uniqueList[$i] ?? null;
    }

    private function removeItemIfPresent(string $item): void
    {
        $key = array_search($item, $this->uniqueList, true);
        if (false === $key) {
            return;
        }

        array_splice($this->uniqueList, $key, 1);
    }

    private function removeOldestIfLengthLimitIsReached(): void
    {
        if (count($this->uniqueList) !== $this->length) {
            return;
        }

        array_unshift($this->uniqueList);
    }
}
