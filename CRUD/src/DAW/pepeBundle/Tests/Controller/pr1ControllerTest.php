<?php

namespace DAW\pepeBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class pr1ControllerTest extends WebTestCase
{
    public function testPr1()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/pr1');
    }

}
