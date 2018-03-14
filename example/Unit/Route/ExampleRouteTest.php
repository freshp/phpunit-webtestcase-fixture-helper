<?php

namespace FreshP\PhpunitWebtestcaseFixtureHelper\Tests\Unit\Action;

use FreshP\PhpunitWebtestcaseFixtureHelper\Tests\Fixtures\DataFixtures\ORM\LoadFixtures;
use FreshP\PhpunitWebtestcaseFixtureHelper\Tests\Helper\ApiTestCase;
use Symfony\Component\HttpFoundation\Response;

class ExampleRouteTest extends ApiTestCase
{
    /**
     * @throws \Exception
     */
    public static function setUpBeforeClass()
    {
        self::createClientWithDatabaseAndFixtures(new LoadFixtures());
    }

    public function testRouteExample()
    {
        self::$client->request('GET', '/example/route');

        $response = self::$client->getResponse();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }
}
