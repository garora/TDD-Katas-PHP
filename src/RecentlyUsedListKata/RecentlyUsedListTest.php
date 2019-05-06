<?php

namespace TDD\RecentlyUsedListKata;

use PHPUnit\Framework\TestCase;

class RecentlyUsedListTest extends TestCase
{
    private const MAXIMUM_TESTED_LENGTH = 100;

    private const BASE_LENGTH = 3;

    public function testIsInitiallyEmpty(): void
    {
        $recentlyUsedList = new RecentlyUsedList();

        $this->assertNull($recentlyUsedList->dequeue());
    }

    public function testIsLastInFirstOut(): void
    {
        $recentlyUsedList = $this->buildTripletList();

        for ($i = self::BASE_LENGTH; $i >= 1; --$i) {
            $this->assertEquals("item $i", $recentlyUsedList->dequeue());
        }
    }

    public function testCanLookUpByIndex(): void
    {
        $recentlyUsedList = $this->buildTripletList();

        $this->assertEquals('item 3', $recentlyUsedList->get(0));
        $this->assertEquals('item 2', $recentlyUsedList->get(1));
        $this->assertEquals('item 1', $recentlyUsedList->get(2));
    }

    public function testNoItemForIndexReturnsNull(): void
    {
        $recentlyUsedList = new RecentlyUsedList();

        $this->assertNull($recentlyUsedList->get(0));
    }

    public function testItemsAreUnique(): void
    {
        $recentlyUsedList = $this->buildTripletList();

        $recentlyUsedList->enqueue('item 2');

        $this->assertEquals('item 2', $recentlyUsedList->get(0));
        $this->assertEquals('item 3', $recentlyUsedList->get(1));
        $this->assertEquals('item 1', $recentlyUsedList->get(2));
    }

    public function usesDefaultLimitIfNoneProvided(): void
    {
        $recentlyUsedList = new RecentlyUsedList();

        $property = new \ReflectionProperty(RecentlyUsedList::class, 'length');
        $property->setAccessible(true);
        $actual = $property->getValue($recentlyUsedList);

        $this->assertEquals(RecentlyUsedList::DEFAULT_LENGTH, $actual);
    }

    public function testUnlimitedList(): void
    {
        $recentlyUsedList = new RecentlyUsedList(-1);

        for ($i = 0; $i < self::MAXIMUM_TESTED_LENGTH; ++$i) {
            $recentlyUsedList->enqueue("item $i");
        }

        for ($i = self::MAXIMUM_TESTED_LENGTH - 1; $i > 0; --$i) {
            $recentlyUsedList->dequeue();
        }

        $this->assertNotNull($recentlyUsedList->dequeue());
        $this->assertNull($recentlyUsedList->dequeue());
    }

    public function testDoesNotAllowNull(): void
    {
        $recentlyUsedList = new RecentlyUsedList();

        $this->expectException(\TypeError::class);
        $recentlyUsedList->enqueue(null);
    }

    /**
     * @dataProvider outOfBoundDataProvider
     */
    public function testThrowsExceptionWhenIndexIsOutOfBound(int $bound): void
    {
        $recentlyUsedList = $this->buildTripletList();

        $this->expectException(\OutOfBoundsException::class);
        $recentlyUsedList->get($bound);
    }

    public function outOfBoundDataProvider(): array
    {
        return [
            'index is negative' => [-1],
            'index is bigger than list length' => [self::BASE_LENGTH],
        ];
    }

    private function buildTripletList(): RecentlyUsedList
    {
        $recentlyUsedList = new RecentlyUsedList(self::BASE_LENGTH);

        for ($i = 1; $i <= self::BASE_LENGTH; ++$i) {
            $recentlyUsedList->enqueue("item $i");
        }

        return $recentlyUsedList;
    }
}
