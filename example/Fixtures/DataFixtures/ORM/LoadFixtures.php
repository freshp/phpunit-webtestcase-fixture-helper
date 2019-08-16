<?php

namespace FreshP\PhpunitWebtestcaseFixtureHelper\Tests\Fixtures\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use FreshP\PhpunitWebtestcaseFixtureHelper\Fixtures\DataFixtures\Entity\TestObjectFixture;

class LoadFixtures implements FixtureInterface
{
    use TestObjectFixture;

    public function load(ObjectManager $manager): void
    {
        $testObject = $this->getTestObjectFixture();
        $manager->persist($testObject);

        $manager->flush();
    }
}
