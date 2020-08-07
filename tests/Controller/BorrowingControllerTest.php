<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BorrowingControllerTest extends WebTestCase
{
    public function testExpectedBorrowings()
    {
        $client = static::createClient();

        $client->request('GET', '/borrowing/eb');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertSelectorTextContains('html h1.title', 'Emprunts expirés');
    }
}
