<?php

namespace App\Tests;

use Generator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IndexControllerTest extends WebTestCase
{
    /**
     * @dataProvider DataProviderTestThatClientIpWorks
     *
     * @testdox Test that controller returns `$expectedJson` when using `$remoteAddr` as `REMOTE_ADDR`
     */
    public function testThatClientIpWorks(string $expectedJson, string $remoteAddr): void
    {
        $client = static::createClient(server: ['REMOTE_ADDR' => $remoteAddr]);
        $client->request('GET', '/');

        self::assertSame($expectedJson, $client->getResponse()->getContent());
    }

    public function DataProviderTestThatClientIpWorks(): Generator
    {
        foreach (['1.1.1.1', '1.1.1.2', '1.1.1.3', 'foo', 'bar'] as $ip) {
            yield [json_encode(['clientIp' => $ip, 'remoteAddr' => $ip]), $ip];
        }
    }
}
