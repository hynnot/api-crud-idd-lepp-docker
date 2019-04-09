<?php

namespace Tests\Functional;

class WelcomeTest extends BaseTestCase
{
    public function testShowWelcomeMessageWhenGetHomepage()
    {
        $response = $this->runApp('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Welcome to your phone book', (string)$response->getBody());
        $this->assertNotContains('Hello', (string)$response->getBody());
    }

}