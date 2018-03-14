# phpunit webtestcase doctrine fixture helper

handle doctrine fixtures for test environment while webtests

### usage
1. create a FixtureInterface like the example class `example/Fixtures/DataFixtures/ORM/LoadFixtures.php`
2. write a test-class like `example/Unit/Route/ExampleRouteTest.php` a extend from the given ApiTestCase
3. use static access to create the client for example in the `setUpBeforeClass` or the `setUp` method
    ```
    self::createClientWithDatabaseAndFixtures(new LoadFixtures());
    ```
