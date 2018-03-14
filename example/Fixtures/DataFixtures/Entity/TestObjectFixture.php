<?php

namespace FreshP\PhpunitWebtestcaseFixtureHelper\Fixtures\DataFixtures\Entity;

trait TestObjectFixture
{
    protected $title = 'test';

    protected function getTestObjectFixture(): \stdClass
    {
        $test = new \stdClass();
        $test->title = $this->title;

        return $test;
    }
}
