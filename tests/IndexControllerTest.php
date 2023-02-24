<?php

namespace App\Tests;

use Generator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IndexControllerTest extends WebTestCase
{
    /**
     * @dataProvider dataProviderTestThatClientIpWorks
     *
     * @testdox Test that controller returns `$expectedJson` when using `$remoteAddr` as `REMOTE_ADDR`
     */
    public function testThatClientIpWorks(string $expectedJson, string $remoteAddr): void
    {
        $client = static::createClient(server: ['REMOTE_ADDR' => $remoteAddr]);
        $client->request('GET', '/');

        self::assertResponseIsSuccessful();

        $responseContent = $client->getResponse()->getContent();

        self::assertJson($responseContent);
        self::assertJsonStringEqualsJsonString($expectedJson, $responseContent);
    }

    public function dataProviderTestThatClientIpWorks(): Generator
    {
        foreach (['1.1.1.1', '1.1.1.2', '1.1.1.3', 'foo', 'bar'] as $ip) {
            yield [json_encode(['clientIp' => $ip, 'remoteAddr' => $ip]), $ip];
        }
    }
}
