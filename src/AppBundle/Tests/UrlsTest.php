<?php

namespace AppBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UrlsTest extends WebTestCase
{
    /** @dataProvider provideUrls */
    public function testPageIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function provideUrls()
    {
        return array(
            array('/'),
            array('/video/'),
            array('/user/'),
            array('/features/'),
            //array('/test/'), //will fail as behind security wall
            // ...
        );
    }
} 