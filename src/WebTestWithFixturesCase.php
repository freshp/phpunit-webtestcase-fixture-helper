<?php

namespace FreshP\PhpunitWebtestcaseFixtureHelper;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\StringInput;

class WebTestWithFixtures extends WebTestCase
{
    /**
     * @var Client
     */
    protected static $client;

    private const POSSIBLE_ENVIRONMENTS = [
        'test',
        'dev',
    ];

    /**
     * @param FixtureInterface $loadFixtureClass
     *
     * @throws \Exception
     */
    public static function createClientWithDatabaseAndFixtures(FixtureInterface $loadFixtureClass)
    {
        $environment = self::getEnvironment();

        self::$client = self::createClient([
            'environment' => $environment,
        ]);
        self::dropDatabase();
        self::createDatabase($environment);
        self::migrate();
        self::loadFixtures($loadFixtureClass);
    }

    protected static function loadFixtures(FixtureInterface $loadFixtureClass): void
    {
        $loadFixtureClass->load(
            self::$client->getKernel()->getContainer()->get('doctrine')->getManager()
        );
    }

    /**
     * @throws \Exception
     */
    protected static function createDatabase(string $environment): void
    {
        $input = new ArrayInput([
            'command' => 'doctrine:database:create',
            '--env' => $environment,
        ]);

        self::runCommand($input);
    }

    /**
     * @throws \Exception
     */
    protected static function dropDatabase(): void
    {
        $input = new ArrayInput([
            'command' => 'doctrine:database:drop',
            '--force'
        ]);

        self::runCommand($input);
    }

    /**
     * @throws \Exception
     */
    protected static function migrate(): void
    {
        $input = new ArrayInput([
            'command' => 'doctrine:schema:update',
            '--force'
        ]);

        self::runCommand($input);
    }

    /**
     * @throws \Exception
     */
    protected static function runCommand(ArrayInput $command): int
    {
        $commands = sprintf('%s --quiet', $command);

        $application = new Application(self::$client->getKernel());
        $application->setAutoExit(false);

        return $application->run(new StringInput($commands));
    }

    /**
     * @throws \RuntimeException
     */
    protected static function getEnvironment(): string
    {
        $environment = getenv('APP_ENV');
        if (false === $environment) {
            $environment = 'test';
        }

        if (false === in_array(strtolower($environment), self::POSSIBLE_ENVIRONMENTS)) {
            throw new \RuntimeException(
                sprintf(
                    'it is not recommended to drop databases or use schema update in other environments than %s',
                    implode(', ', self::POSSIBLE_ENVIRONMENTS)
                )
            );
        }

        return $environment;
    }
}
