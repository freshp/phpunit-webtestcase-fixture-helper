# phpunit webtestcase doctrine fixture helper

This package can easily setup database for tests for `dev` or `test`-environments. 
Uses doctrine `FixtureInterface` for edge to edge tests. 

tasks:
 * drop the current database
 * create a new blank database for `dev` or `test` environment
 * migrate by forcing the doctrine schema update
 * load all fixtures by given `FixtureInterface` 

### usage
1. create a FixtureInterface like the example class `example/Fixtures/DataFixtures/ORM/LoadFixtures.php`
2. write a test-class like `example/Unit/Route/ExampleRouteTest.php` a extend from the given ApiTestCase
3. use static access to create the client for example in the `setUpBeforeClass` or the `setUp` method
    ```
    self::createClientWithDatabaseAndFixtures(new LoadFixtures());
    ```
