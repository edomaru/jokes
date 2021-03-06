<?php

namespace Masaruedo\Jokes\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Masaruedo\Jokes\JokeFactory;
use PHPUnit\Framework\TestCase;

class JokeFactoryTest extends TestCase
{
    /** @test */
    public function it_returns_a_random_joke()
    {
        $mock = new MockHandler([
            new Response(200, [], '{ "type": "success", "value": { "id": 69, "joke": "Scientists have estimated that the energy given off during the Big Bang is roughly equal to 1CNRhK (Chuck Norris Roundhouse Kick).", "categories": [ "nerdy" ] } }'),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $jokes = new JokeFactory($client);

        $joke = $jokes->getRandomJoke();

        $this->assertSame('Scientists have estimated that the energy given off during the Big Bang is roughly equal to 1CNRhK (Chuck Norris Roundhouse Kick).', $joke);
    }
}
