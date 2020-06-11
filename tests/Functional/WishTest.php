<?php
declare(strict_types=1);

namespace App\Tests\Functional;

use Domain\State\Archived;
use Domain\State\Obtained;
use Domain\Title;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Faker\Factory as Faker;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

class WishTest extends WebTestCase
{
    protected static $client;

    public static function client(): KernelBrowser
    {
        if (!static::$client) {
            static::$client = static::createClient();
        }
        return static::$client;
    }

    public function testDelete()
    {
        $wish = $this->randomWish();
        $response = $this->createWish($wish);
        static::client()->request('DELETE', '/wishes/'. $response['id']);
        $this->assertEquals(Response::HTTP_OK, static::client()->getResponse()->getStatusCode());
    }

    public function testShow()
    {
        $wish = $this->randomWish();
        $result = $this->createWish($wish);
        static::client()->request('GET', '/wishes/'. $result['id']);
        $this->assertEquals(Response::HTTP_OK, static::client()->getResponse()->getStatusCode());
    }

    public function testUpdate()
    {
        $faker = Faker::create();
        $wish = [
            'title' => $faker->text(Title::MAX_LENGTH),
            'price' => $faker->randomFloat(2),
        ];
        $response = $this->createWish($wish);
        $wish['title'] = $faker->text(Title::MAX_LENGTH);
        static::client()->request('PUT', '/wishes/'.$response['id'], [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($wish));
        $this->assertEquals(Response::HTTP_OK, static::client()->getResponse()->getStatusCode());
        $response = json_decode(static::client()->getResponse()->getContent(), true);
        $this->assertEquals($response['title'], $wish['title']);
    }

    public function testMoveState()
    {
        $wish = $this->randomWish();
        $wish = $this->createWish($wish);
        static::client()->request('PUT', '/wishes/'.$wish['id'].'/state/'.Obtained::SLUG_OBTAINED);
        $response = json_decode(static::client()->getResponse()->getContent(), true);
        $this->assertEquals(Obtained::SLUG_OBTAINED, $response['state']);
        static::client()->request('PUT', '/wishes/'.$wish['id'].'/state/'.Archived::SLUG_ARCHIVED);
        $response = json_decode(static::client()->getResponse()->getContent(), true);
        $this->assertEquals(Archived::SLUG_ARCHIVED, $response['state']);
    }

    private function createWish(array $wish): array
    {
        static::client()->request('POST', '/wishes', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($wish));
        $this->assertEquals(Response::HTTP_CREATED, static::client()->getResponse()->getStatusCode());
        $response = json_decode(static::client()->getResponse()->getContent(), true);
        $this->assertEquals($response['title'], $wish['title']);
        $this->assertEquals($response['price'], $wish['price']);
        return $response;
    }

    private function randomWish(): array
    {
        $faker = Faker::create();
        return [
            'title' => $faker->text(Title::MAX_LENGTH),
            'price' => $faker->randomFloat(2),
        ];
    }
}
