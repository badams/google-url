<?php

namespace badams\GoogleUrl\tests;

use badams\GoogleUrl\Actions\Shorten;
use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Mock;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Stream\Stream;

class ShortenTest extends \PHPUnit_Framework_TestCase
{
    public function testSuccessfulShorten()
    {
        $client = new Client();
        $content = Stream::factory('{"kind": "urlshortener#url", "id": "http://goo.gl/mR2d", "longUrl": "http://google.com/"}');
        $mock = new Mock([new Response(200, [], $content)]);
        $client->getEmitter()->attach($mock);

        $url = new \badams\GoogleUrl\GoogleUrl($key = '123', $client);

        $resource = $url->shorten('http://google.com');
        $this->assertInstanceOf('\badams\GoogleUrl\Resources\Url', $resource);
        $this->assertEquals('http://goo.gl/mR2d', $resource->id);
        $this->assertEquals('http://google.com/', $resource->longUrl);
    }

    public function testNoUrl()
    {
        $this->setExpectedException('\badams\GoogleUrl\Exceptions\GoogleUrlException', 'No URL provided');
        new Shorten('');
    }
}
