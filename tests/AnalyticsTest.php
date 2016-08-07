<?php

namespace badams\GoogleUrl\tests;

use badams\GoogleUrl\Actions\Expand;
use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Mock;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Stream\Stream;
use badams\GoogleUrl\Resources\Analytics;

class AnalyticsTest extends \PHPUnit_Framework_TestCase
{
    public function testFullAnalytics()
    {
        $client = new Client();
        $json = file_get_contents(__DIR__ . '/data/analytics-full.json');
        $content = Stream::factory($json);
        $mock = new Mock([new Response(200, [], $content)]);
        $client->getEmitter()->attach($mock);

        $url = new \badams\GoogleUrl\GoogleUrl($key = '123', $client);

        $resource = $url->expand('http://goo.gl/mR2d', Analytics::FULL);
        $this->assertInstanceOf('\badams\GoogleUrl\Resources\Url', $resource);
        $this->assertEquals('http://goo.gl/mR2d', $resource->id);
        $this->assertEquals('http://google.com/', $resource->longUrl);
        $this->assertInstanceOf('\badams\GoogleUrl\Resources\Analytics', $resource->analytics);

        $this->assertEquals("929824", $resource->analytics->allTime->shortUrlClicks);
        $this->assertEquals("34972779", $resource->analytics->allTime->longUrlClicks);
        $this->assertTrue(is_array($resource->analytics->allTime->referrers));
        $this->assertTrue(is_array($resource->analytics->allTime->platforms));
        $this->assertTrue(is_array($resource->analytics->allTime->browsers));

        $this->assertEquals("953", $resource->analytics->month->shortUrlClicks);
        $this->assertEquals("1660967", $resource->analytics->month->longUrlClicks);
        $this->assertTrue(is_array($resource->analytics->allTime->referrers));
        $this->assertTrue(is_array($resource->analytics->allTime->platforms));
        $this->assertTrue(is_array($resource->analytics->allTime->browsers));
    }

    public function testInvalidProjection()
    {
        $this->setExpectedException('\badams\GoogleUrl\Exceptions\GoogleUrlException', 'Invalid Projection Parameter');
        new Expand('http://goo.gl/mR2d', 'foo');
    }
}
