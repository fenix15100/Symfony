<?php

namespace DAW\pepeBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AlumnesControllerTest extends WebTestCase
{
    public function testNew()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/new');
    }

    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
    }

}
