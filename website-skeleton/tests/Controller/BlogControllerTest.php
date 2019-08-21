<?php
/**
 * Created by PhpStorm.
 * User: cedri
 * Date: 19-08-19
 * Time: 22:22
 */

namespace Test\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BlogControllerTest extends WebTestCase
{
    public function testShowGet()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testShowGetBlog()
    {
        $client = static::createClient();

        $client->request('GET', '/blog');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testShowId()
    {
        $client = static::createClient();

        $client->request('GET', 'blog/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testShowEdit() {
        $client = static::createClient();

        $client->request('GET', 'blog/1/edit');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testShowHomeWelcomH1() {
        $client = static::createClient();

       $crawler =  $client->request('GET', '/');

        $this->assertEquals("Welcom in this blog", $crawler->filter(h1)->text());
    }

    public function testShowIndexTitle() {
        $client = static::createClient();

        $crawler =  $client->request('GET', '/blog');

        $this->assertEquals("Hello BlogController", $crawler->filter(title)->text());
    }


}