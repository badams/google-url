<?php

namespace badams\GoogleUrl\tests;

use badams\GoogleUrl\GoogleUrl;
use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Mock;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Stream\Stream;

class GoogleUrlTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $url = new GoogleUrl('123');
        $reflection = new \ReflectionClass($url);
        $client = $reflection->getProperty('http');
        $client->setAccessible(true);
        $this->assertNotNull($client->getValue($url));
        $this->assertInstanceOf('\GuzzleHttp\Client', $client->getValue($url));
    }

    public function testInvalidKey()
    {
        $this->setExpectedException('\badams\GoogleUrl\Exceptions\InvalidKeyException', 'Invalid API key');

        $client = new Client();
        $content = Stream::factory(json_encode([
            'error' => [
                'errors' => [
                    [
                        'domain' => 'usageLimits',
                        'reason' => 'keyInvalid',
                        'message' => 'Bad Request',
                    ]
                ],
                'code' => 400,
                'message' => 'Bad Request'
            ]
        ]));

        $mock = new Mock([new Response(400, [], $content)]);
        $client->getEmitter()->attach($mock);

        (new \badams\GoogleUrl\GoogleUrl($key = '123', $client))->shorten('http://google.com');
    }

    public function testInvalidValue()
    {
        $this->setExpectedException('\badams\GoogleUrl\Exceptions\InvalidValueException',
            'Invalid Parameter Value: resource.longUrl');

        $client = new Client();
        $content = Stream::factory(json_encode([
            'error' => [
                'errors' => [
                    [
                        'domain' => 'global',
                        'reason' => 'invalid',
                        'message' => 'Invalid Value',
                        'locationType' => 'parameter',
                        'location' => 'resource.longUrl'
                    ]
                ],
                'code' => 400,
                'message' => 'Invalid Value'
            ]
        ]));

        $mock = new Mock([new Response(400, [], $content)]);
        $client->getEmitter()->attach($mock);
        (new \badams\GoogleUrl\GoogleUrl($key = '123', $client))->shorten('http://google.com');
    }

    public function testUnknownException()
    {
        $this->setExpectedException('\badams\GoogleUrl\Exceptions\GoogleUrlException', 'Some Unexpected Response!');

        $client = new Client();
        $content = Stream::factory('Some Unexpected Response!');

        $mock = new Mock([new Response(500, [], $content)]);
        $client->getEmitter()->attach($mock);
        (new \badams\GoogleUrl\GoogleUrl($key = '123', $client))->shorten('http://google.com');
    }
}
