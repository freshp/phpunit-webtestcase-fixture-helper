<?php

namespace FreshP\PhpunitWebtestcaseFixtureHelper\Tests\Unit\Action;

use Exception;
use FreshP\PhpunitWebtestcaseFixtureHelper\Tests\Fixtures\DataFixtures\ORM\LoadFixtures;
use FreshP\PhpunitWebtestcaseFixtureHelper\WebTestCaseWithFixtures;
use Symfony\Component\HttpFoundation\Response;

class ExampleRouteTest extends WebTestCaseWithFixtures
{
    /**
     * @throws Exception
     */
    public static function setUpBeforeClass(): void
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
